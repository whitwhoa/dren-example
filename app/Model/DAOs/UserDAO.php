<?php


namespace App\Model\DAOs;


use Dren\DAO;



class UserDAO extends DAO
{
    public function createNewUser(array $u) : int
    {


        return $this->db
            ->query("INSERT INTO users(first_name, last_name, email, password) VALUES(?,?,?,?)", (array)$u)
            ->exec();
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

    public function emailExists(string $email) : bool
    {
        //return $this->getUserByEmail($email) != null;
        return true;
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