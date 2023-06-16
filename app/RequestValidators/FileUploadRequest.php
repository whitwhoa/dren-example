<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class FileUploadRequest extends RequestValidator
{
    protected string $failureResponseType = 'redirect'; // or json

    public function setRules(): void
    {
        // TODO: left off here once I realized I dont think I handled optional form elements in the base
        // RequestValidator...so we've gotta figure that out
        $this->rules = [
            'image1' => 'required|is_file'
        ];

        $this->messages = [

        ];
    }
}