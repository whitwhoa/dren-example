<?php


namespace App\Model\DAOs;


use Dren\DAO;
use Exception;


class UserDAO extends DAO
{
    /**
     * @throws Exception
     */
    public function createNewUser(object $u) : int
    {
        // use transaction when dealing with multiple queries that depend on the previous query's successful execution
        try
        {
            $this->db->beginTransaction();

            // create `accounts` record
            $q1 = <<<EOT
                INSERT INTO accounts (username, password, last_active, last_ip) VALUES (?, ?, ?, ?)
            EOT;

            $newUserId = $this->db
                ->query($q1, [$u->email, $u->password, date("Y-m-d H:i:s"), $u->ip])
                ->exec();

            // create `user_profiles` record
            $q2 = <<<EOT
                INSERT INTO user_profiles (account_id, first_name, last_name, email) VALUES (?, ?, ?, ?)
            EOT;

            $this->db
                ->query($q2, [$newUserId, $u->firstName, $u->lastName, $u->email])
                ->exec();

            // create account_role junction
            $q3 = <<<EOT
                INSERT INTO account_role (account_id, role_id) VALUES (?, ?)
            EOT;

            $this->db
                ->query($q3, [$newUserId, 1])
                ->exec();

            $this->db->commitTransaction();

            return $newUserId;
        }
        catch(Exception $e)
        {
            $this->db->rollbackTransaction();

            throw new Exception($e->getMessage()); // handle further up the stack
        }

    }
    public function getUserById(int $id) : ?object
    {
        $q = <<<EOT
            SELECT accounts.*, user_profiles.*
            FROM accounts
            JOIN user_profiles ON accounts.id = user_profiles.account_id
            WHERE accounts.id = ?
        EOT;

        return $this->db
            ->query($q, [$id])
            ->singleAsObj()
            ->exec();
    }

    public function getUserByUsername(string $username) : ?object
    {
        $q = <<<EOT
            SELECT accounts.*, user_profiles.*
            FROM accounts
            JOIN user_profiles ON accounts.id = user_profiles.account_id
            WHERE accounts.username = ?
        EOT;

        return $this->db
            ->query($q, [$username])
            ->singleAsObj()
            ->exec();
    }

    public function getRoles(int $userId): array
    {
        $q = <<<EOT
            SELECT 
                roles.role
            FROM accounts
            JOIN account_role ON accounts.id = account_role.account_id
            JOIN roles ON account_role.role_id = roles.id
            WHERE accounts.id = ?;
        EOT;

        $resultSet = $this->db
            ->query($q, [$userId])
            ->asObj()
            ->exec();

        $roles = [];
        foreach($resultSet as $r)
            $roles[] = $r->role;

        return $roles;
    }

    public function getKeyVals(int $id) : array
    {
        return $this->db
            ->query("SELECT * FROM key_vals WHERE user_id = ?", [$id])
            ->asObj()
            ->exec();
    }

    public function getKeyValsWithNotes(int $id) : array
    {
        $query = <<<EOT
            SELECT key_vals.*,
            (
            SELECT 
                JSON_ARRAYAGG(
                    JSON_OBJECT('note', key_val_notes.note)
                )
            FROM 
                key_val_notes
            WHERE 
                key_val_notes.key_val_id = key_vals.id
            ) AS notes 
            FROM key_vals 
            WHERE user_id = ?
        EOT;

        return $this->db
            ->query($query, [$id])
            ->asObj()
            ->exec();
    }

    public function getAllUsers() : array
    {
        return $this->db
            ->query("SELECT * FROM users")
            ->asObj()
            ->exec();
    }

    public function setKeyValsWithNotes(int $userId, array $keyVals) : void
    {
        foreach($keyVals as $kv)
        {
            $newKvId = $this->db->query("INSERT INTO key_vals(`user_id`, `key`, `val`) VALUES (?,?,?)", [$userId, $kv['key'], $kv['value']])->exec();
            if(array_key_exists('notes', $kv))
                foreach($kv['notes'] as $n)
                    $this->db->query("INSERT INTO key_val_notes(key_val_id, note) VALUES(?,?)", [$newKvId, $n])->exec();
        }
    }


}