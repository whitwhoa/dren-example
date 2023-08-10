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

    public function authenticate(string $username, string $password): ?object
    {
        $u = $this->userDAO->getUserByUsername($username);

        if(!$u)
            return null;

        if(!password_verify($password, $u->password))
            return null;

        return $u;
    }

}