<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class FileUploadRequest extends RequestValidator
{
    protected string $failureResponseType = 'redirect'; // or json

    public function setRules(): void
    {
        $this->rules = [
            'images' => 'required|is_array',
            'image1' => 'nullable|is_file'
        ];

        $this->messages = [

        ];
    }
}