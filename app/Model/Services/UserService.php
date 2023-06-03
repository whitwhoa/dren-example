<?php


namespace App\Model\Services;


use App\Model\Entities\User;
use Dren\App;


class UserService
{

    /**
     *
     *
     * @param object $params
     * @throws \Exception
     */
    public static function createNewUser(object $params) : void
    {
        $u = new User();
        $u->first_name = $params->firstName;
        $u->last_name = $params->lastName;
        $u->email = $params->email;
        $u->password = password_hash($params->password, PASSWORD_DEFAULT);
        $u->save();

        App::$sm->regenerate(true, $u->id);

    }

    /**
     *
     *
     * @param string $email
     * @throws \Exception
     */
    public static function login(string $email) : void
    {
        $u = User::findByEmail($email);
        App::$sm->regenerate(true, $u->id);
    }

}