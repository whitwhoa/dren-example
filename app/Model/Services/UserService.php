<?php


namespace App\Model\Services;


use App\Model\DAOs\UserDAO;
use Dren\Service;


class UserService extends Service
{
    private UserDAO $userDAO;


    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
    }

    public function createNewUser(object $params) : ?int
    {
        return $this->userDAO->createNewUser([
            $params->firstName,
            $params->lastName,
            $params->email,
            password_hash($params->password, PASSWORD_DEFAULT)
        ]);
    }

}