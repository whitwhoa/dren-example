<?php


namespace App\FormDataValidators;


use Dren\FormDataValidator;



class AuthRegisterValidator extends FormDataValidator
{

    public function setRules(): void
    {
        $this->rules = [
            'firstName' => 'required|min_char:2|max_char:50',
            'lastName' => 'required|min_char:2|max_char:50',
            'email' => 'required|email|unique:users,email',
            'confirmPassword' => 'required|min_char:8|max_char:100',
            'password' => 'required|min_char:8|max_char:100|same:confirmPassword'
        ];

        $this->messages = [
            'firstName.required' => 'This is a custom error message for the required rule on the firstName element'
        ];
    }
}