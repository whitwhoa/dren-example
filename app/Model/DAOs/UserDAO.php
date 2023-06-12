<?php


namespace App\Model\DAOs;


use Dren\DAO;



class UserDAO extends DAO
{
    public function createNewUser(array $u) : int
    {
        //dad((array)$u);
        echo "got here\n";
        return $this->db
            ->query("INSERT INTO users(first_name, last_name, email, password) VALUES(?,?,?,?)", (array)$u)
            ->exec();
    }
    public function getUserById(int $id) : ?object
    {
        return $this->db
            ->query("SELECT * FROM users WHERE id = ?", [$id])
            ->singleAsObj()
            ->exec();
    }

    public function getUserByEmail(string $email) : ?object
    {
        return $this->db
            ->query("SELECT * FROM users WHERE email = ?", [$email])
            ->singleAsObj()
            ->exec();
    }

    public function emailExists(string $email) : bool
    {
        return $this->getUserByEmail($email) != null;
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