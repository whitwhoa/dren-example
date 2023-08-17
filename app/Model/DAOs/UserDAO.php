<?php


namespace App\Model\DAOs;



use Dren\Model\DAOs\AccountDAO;
use Dren\MySQLCon;
use Exception;


class UserDAO extends AccountDAO
{
    /**
     * @throws Exception
     */
    public function createNewUser(object $u) : int
    {
        $firstName = $u->firstName;
        $lastName = $u->lastName;
        $email = $u->email;

        return $this->createNewAccount($u->email, $u->password, $u->ip, ['user'],
            function(int $accountId, MySQLCon $db) use($firstName, $lastName, $email){

            $q = <<<EOT
                INSERT INTO user_profiles (account_id, first_name, last_name, email) VALUES (?, ?, ?, ?)
            EOT;

            $this->db
                ->query($q, [$accountId, $firstName, $lastName, $email])
                ->exec();
        });
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