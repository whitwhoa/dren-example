<?php


namespace App\Http\FormDataValidators;


use Dren\FormDataValidator;


class FileUploadValidator extends FormDataValidator
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