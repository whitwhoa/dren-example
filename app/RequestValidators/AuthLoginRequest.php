<?php


namespace App\RequestValidators;


use App\Model\Entities\User;
use Dren\RequestValidator;



class AuthLoginRequest extends RequestValidator
{

    protected string $failureResponseType = 'redirect'; // or json

    public function setRules(): void
    {
        $this->rules = [
            'email' => ['required','email'],
            'password' => 'required|max_char:100',
            '_generic_' => [function(&$requestData, &$errors){

                // TODO: implement a fence that can be added to existing validation rules that
                // tells the system, "hey, if validation for this fails, STOP processing any other validation rules"
                // which would in turn make the below conditional obsolete
                if(!isset($requestData['password']) || !isset($requestData['email']))
                {
                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
                    return;
                }


                $u = User::findByEmail($requestData['email']);

                if(!$u)
                {
                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
                    return;
                }

                if(!password_verify($requestData['password'], $u->password))
                {
                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
                    return;
                }

            }]
        ];

        $this->messages = [

        ];
    }

    /**
     * Set valitron rules where $this->valitron is an instance of new Valitron\Validator()
     */
    public function rules() : void
    {

        $v = $this->valitron;
        $v->rule('required', ['email', 'password']);
        $v->rule('email', 'email');

        // Verify that the given email exists and that the given password is associated with the account
        $v->rule(function($field, $value, $params, $fields){

            if(!User::emailExists($value)){
                return false;
            }

            $u = User::findByEmail($value);

            if(!password_verify($fields['password'], $u->password)){
                return false;
            }

            return true;

        }, "email")->message('Provided credentials are incorrect');

    }

}