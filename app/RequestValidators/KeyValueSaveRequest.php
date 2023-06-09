<?php


namespace App\RequestValidators;


use Dren\RequestValidator;



class KeyValueSaveRequest extends RequestValidator
{
    protected string $failureResponseType = 'redirect'; // or json

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
            'keyValPair' => 'required|#is_array|#min_array_elements:1'
            // TODO: left off here
        ];

        $this->messages = [

        ];
    }
}