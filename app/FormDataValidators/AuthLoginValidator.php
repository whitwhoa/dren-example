<?php


namespace App\FormDataValidators;



use App\Model\DAOs\UserDAO;
use App\Model\Services\UserService;
use Dren\Request;
use Dren\FormDataValidator;



class AuthLoginValidator extends FormDataValidator
{
    private UserService $userService;

    public function __construct(Request $r)
    {
        parent::__construct($r);

        $this->userService = new UserService();
    }

    public function setRules(): void
    {
        // "#" denotes a fence. Can be prepended to any method name in order to tell the validator to NOT
        // process any other validation errors after this method has executed if it has failed
        $this->rules = [
            'email' => ['required','email'],
            'password' => 'required|#max_char:100',
            '_generic_' => [function(&$requestData, &$errors, &$fenceUp){

                $u = $this->userService->authenticate($requestData['email'], $requestData['password']);

                if(!$u)
                    $errors->add('authentication_failure', "Provided credentials are incorrect");

            }]
        ];

        $this->messages = [
            'email.required' => "Custom message for email required validation failure"
        ];
    }

}