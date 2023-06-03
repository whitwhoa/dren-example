<?php


namespace App\Model\Entities;


use Dren\Entity;
use Dren\App;



class User extends Entity
{

    protected $hasDbCon = true; // If not specified, will default to true. Set to false if this model does not require database connectivity.
    protected $dbName = 'dren'; // If not specified, will connect to the first database within configuration file
    protected $table = 'users'; // Required


    /*
     *  Entity provides basic SELECT, INSERT, UPDATE, and DELETE functionality for a single
     *  instantiated instance (See Docs). ANY additional functionality ie more complex queries
     *  related to the defined $table property can be (and are intended to be) implemented within
     *  these classes. In short: ALL DATABASE INTERACTION IS TO BE IMPLEMENTED WITHIN AN ENTITY CLASS!
     *
     *  We are not trying to be a full featured ORM here, just provide a super basic way to work with
     *  single instances of records (creating, finding, updating). The responsibility of more complicated
     *  database interaction falls back onto the developer (so you need a healthy understanding of SQL),
     *  which for small projects that need to perform towards the upper limit of what php is capable of,
     *  turns out to be perfect.
     *
     */


    /**
     * Determine whether or not there is a `users` account associated with the given $email
     *
     * @param string $email
     * @return bool
     * @throws \Exception
     */
    public static function emailExists(string $email) : bool
    {
        $result = App::$db->get()
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->asObj()
            ->exec();
        return count($result) === 1;
    }

    /**
     * Determine whether or not there is a `users` account associated with the given $email
     *
     * @param string $email
     * @return null|object
     * @throws \Exception
     */
    public static function findByEmail(string $email) : ?object
    {
        $result = App::$db->get()
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->singleAsObj()
            ->exec();
        return $result;
    }

    /**
     * Return an array of stdClass objects each representing a `users` row for all rows
     *
     * @return array
     * @throws \Exception
     */
    public static function all() : array
    {
        return App::$db->get()
            ->query("SELECT * FROM users")
            ->asObj()
            ->exec();
    }


}