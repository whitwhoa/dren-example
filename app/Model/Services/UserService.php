<?php


namespace App\Model\Services;


use App\Model\DAOs\UserDAO;
use Dren\Service;
use Exception;


class UserService extends Service
{
    private UserDAO $userDAO;


    public function __construct()
    {
        parent::__construct();

        $this->userDAO = new UserDAO();
    }

    /**
     * $params must include:
     * ->firstName
     * ->lastName
     * ->email
     * ->password
     * ->ip
     *
     * @param object $params
     * @return int|null
     * @throws Exception
     */
    public function createNewUser(object $params) : ?int
    {
        $params->password = password_hash($params->password, PASSWORD_DEFAULT);
        return $this->userDAO->createNewUser($params);
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