<?php


namespace App\FormDataValidators;



use App\Model\DAOs\UserDAO;
use App\Model\Services\UserService;
use Dren\Request;
use Dren\FormDataValidator;
use Dren\SessionManager;


class AuthLoginValidator extends FormDataValidator
{
    private UserService $userService;

    public function __construct(Request $r, SessionManager $sm)
    {
        parent::__construct($r, $sm);

        $this->userService = new UserService();
    }

    public function setRules(): void
    {
        // "#" denotes a fence. Can be prepended to any method name in order to tell the validator to NOT
        // process any other validation errors after this method has executed if it has failed
        $this->rules = [
            'email' => ['required','email'],
            'password' => 'required|#max_char:100',
            // You can add callables to the rules array to create your own custom validation logic.
            // If you want to create a custom callable to for example check user authentication, then
            // you would simply create a key value entry where the key can be whatever you'd like that
            // doesn't conflict with the rest of your rules (it won't be referenced anywhere), and the
            // value follows the same function signature as below:
            '_auth_check' => [function(&$requestData, &$errors, &$fenceUp){

                if(!$this->userService->authenticate($requestData['email'], $requestData['password']))
                    $errors->add('authentication_failure', "Provided credentials are incorrect");

            }]
        ];

        $this->messages = [
            'email.required' => "Custom message for email required validation failure"
        ];
    }

}