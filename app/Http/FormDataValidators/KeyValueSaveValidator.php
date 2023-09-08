<?php


namespace App\Http\FormDataValidators;


use Dren\FormDataValidator;


class KeyValueSaveValidator extends FormDataValidator
{
    /*
     *
(object) array(
   'keyValPair' =>
  array (
    0 =>
    array (
      'key' => 'Key001',
      'value' => 'Value001',
      'notes' =>
      array (
        0 => 'Key001 Note001',
        1 => 'Key001 Note002',
      ),
    ),
    1 =>
    array (
      'key' => 'Key002',
      'value' => 'Value002',
    ),
    2 =>
    array (
      'key' => 'Key003',
      'value' => 'Value003',
      'notes' =>
      array (
        0 => 'Key003 Note003',
      ),
    ),
  ),
)
     *
     * */
    public function setRules(): void
    {
        $this->rules = [
            'keyValPair' => 'required|#is_array|#min_array_elements:1',
            //'keyValPair' => 'required|is_array|min_array_elements:1',
            'keyValPair.*.key' => 'required',
            'keyValPair.*.value' => 'required',
            'keyValPair.*.notes' => 'nullable|#is_array',
            //'keyValPair.*.notes' => '#is_array',
            'keyValPair.*.notes.*' => 'max_char:100'
        ];

        $this->messages = [
            'keyValPair.*.notes.*.max_char' => 'This is a custom error message for notes element max_char method'
        ];
    }
}