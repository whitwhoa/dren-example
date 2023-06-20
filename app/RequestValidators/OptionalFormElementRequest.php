<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class OptionalFormElementRequest extends RequestValidator
{
    public function setRules(): void
    {

        $this->rules = [
            'testTextInput' => 'nullable|min_char:3'
        ];

        $this->messages = [

        ];
    }
}