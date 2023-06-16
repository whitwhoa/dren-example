<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class OptionalFormElementRequest extends RequestValidator
{
    protected string $failureResponseType = 'redirect'; // or json

    public function setRules(): void
    {
        //dad($this->request);
        $this->rules = [
            //'testTextInput' => 'required'
        ];

        $this->messages = [

        ];
    }
}