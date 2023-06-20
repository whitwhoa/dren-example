<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class FileUploadRequest extends RequestValidator
{
    public function setRules(): void
    {
        $this->rules = [
            'images' => 'required|is_array',
            'image1' => 'nullable|is_file|max_file_size:1000|mimetypes:image/jpeg'
        ];

        $this->messages = [

        ];
    }
}