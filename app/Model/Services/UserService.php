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
    public static function createNewUser(object $params) : ?int
    {
        $u = new User();
        $u->first_name = $params->firstName;
        $u->last_name = $params->lastName;
        $u->email = $params->email;
        $u->password = password_hash($params->password, PASSWORD_DEFAULT);
        $u->save();

        return $u->id;
    }

}