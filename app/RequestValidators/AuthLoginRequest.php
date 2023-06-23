<?php


namespace App\RequestValidators;



use App\Model\DAOs\UserDAO;
use Dren\Request;
use Dren\RequestValidator;



class AuthLoginRequest extends RequestValidator
{
    private UserDAO $userDAO;

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
            '_generic_' => [function(&$requestData, &$errors, &$fenceUp){
            
                $u = $this->userDAO->getUserByEmail($requestData['email']);

                if(!$u)
                {
                    $errors->add('authentication_failure', "Provided credentials are incorrect");
                    return;
                }

                if(!password_verify($requestData['password'], $u->password))
                {
                    $errors->add('authentication_failure', "Provided credentials are incorrect");
                    return;
                }

            }]
        ];

        $this->messages = [
            'email.required' => "Custom message for email required validation failure"
        ];
    }

}