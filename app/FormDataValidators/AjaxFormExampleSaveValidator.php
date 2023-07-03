<?php


namespace App\FormDataValidators;


use Dren\FormDataValidator;

/*
 *
 *  'postData' =>
  (object) array(
     'exampleText' => '',
     'exampleSelect' => '1',
     'exampleTextarea' => '',
     'optionsRadios' => 'option1',
     'optionCheckboxes' =>
    array (
      1 => 'value1',
      2 => 'value2',
    ),
  ),
 *
 */

class AjaxFormExampleSaveValidator extends FormDataValidator
{
    public function setRules(): void
    {
        $this->rules = [
            'exampleText' => 'run_all|required|numeric',
            'exampleSelect' => 'in:1,2,3',
            'exampleTextarea' => 'min_char:10',
            'optionsRadios' => 'required|in:opt1,opt2',
            'optionCheckboxes' => 'sometimes|#is_array|max_array_elements:1'
        ];

        $this->messages = [

        ];
    }
}