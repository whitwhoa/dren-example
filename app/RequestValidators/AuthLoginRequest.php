<?php


namespace App\RequestValidators;


use App\Model\Entities\User;
use Dren\RequestValidator;



class AuthLoginRequest extends RequestValidator
{

    protected $failureResponseType = 'redirect'; // or json

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