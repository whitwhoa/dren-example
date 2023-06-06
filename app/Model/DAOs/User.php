<?php


namespace App\Model\DAO;


use Dren\DAO;



class UserDAO extends DAO
{
    public function getKeyVals(int $id) : array
    {
        return $this->db
            ->query("SELECT * FROM key_vals WHERE user_id = ?", [$id])
            ->asObj()
            ->exec();
    }

    /**
     * Determine whether there is a `users` account associated with the given $email
     */
    public function emailExists(string $email) : bool
    {
        $result = $this->db
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->asObj()
            ->exec();
        return count($result) === 1;
    }

    /**
     * Determine whether there is a `users` account associated with the given $email
     */
    public function findByEmail(string $email) : ?object
    {
        return $this->db
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->singleAsObj()
            ->exec();
    }

    /**
     * Return an array of stdClass objects each representing a `users` row for all rows
     */
    public function all() : array
    {
        return $this->db
            ->query("SELECT * FROM users")
            ->asObj()
            ->exec();
    }


}