<?php


namespace App\RequestValidators;


use App\Model\Entities\User;
use Dren\RequestValidator;



class AuthRegisterRequest extends RequestValidator
{

    protected $failureResponseType = 'redirect'; // or json

    /**
     * Set valitron rules where $this->valitron is an instance of new Valitron\Validator()
     */
    public function rules() : void
    {

        $v = $this->valitron;
        $v->rule('required', ['firstName', 'lastName', 'email', 'password', 'confirmPassword']);
        $v->rule('email', 'email');
        $v->rule('equals', 'password', 'confirmPassword');

        // Insure email does not already exist
        $v->rule(function($field, $value, $params, $fields){
            return !User::emailExists($value);
        }, "email")->message('This email address is already associated with an account');

    }

}