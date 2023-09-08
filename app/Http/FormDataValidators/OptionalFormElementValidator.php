<?php


namespace App\Http\FormDataValidators;


use Dren\FormDataValidator;


class OptionalFormElementValidator extends FormDataValidator
{
    public function setRules(): void
    {

        $this->rules = [
            //'testTextInput' => 'sometimes|min_char:3',
            'testTextInput' => 'nullable|min_char:3'
        ];

        $this->messages = [

        ];
    }
}