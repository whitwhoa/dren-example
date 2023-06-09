<?php


namespace App\RequestValidators;



use App\Model\DAOs\UserDAO;
use Dren\Request;
use Dren\RequestValidator;



class AuthLoginRequest extends RequestValidator
{
    private UserDAO $userDAO;

    protected string $failureResponseType = 'redirect'; // or json

    public function __construct(Request $r)
    {
        parent::__construct($r);

        $this->userDAO = new UserDAO();
    }

    public function setRules(): void
    {
        // "#" denotes a fence. Can be prepended to any method name in order to tell the validator to NOT
        // process any other validation errors after this method has executed if it has failed
        $this->rules = [
            'email' => ['required','email'],
            'password' => 'required|#max_char:100',
            '_generic_' => [function(&$requestData, &$errors){

                // Leaving this here as an example to show that this is no longer needed when using the fence "#" character
                // before a validation method call...since the validator will stop processing and kick back to the client
                // after running max_char() above, we know that if we made it into this callable we have the data we
                // need
//                if(!isset($requestData['password']) || !isset($requestData['email']))
//                {
//                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
//                    return;
//                }

                $u = $this->userDAO->getUserByEmail($requestData['email']);

                if(!$u)
                {
                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
                    return;
                }

                if(!password_verify($requestData['password'], $u->password))
                {
                    $errors['authentication_failure'][] = "Provided credentials are incorrect";
                    return;
                }

            }]
        ];

        $this->messages = [
            'email.required' => "Custom message for email required validation failure"
        ];
    }

}