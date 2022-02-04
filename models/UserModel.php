<?php

namespace app\models;

use app\base\DbConnection;
use app\base\Model;
use Exception;
use PDO;

class UserModel extends Model
{

    public string $email;
    public string $password;
    public string $confirm_password;
    public string $type = 'user';

    public function rules(): array
    {
        return [
            'email'            => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password'         => [self::RULE_REQUIRED],
            'confirm_password' => [self::RULE_REQUIRED],
        ];
    }

    public function attributes(): array
    {
        return ['email', 'password', 'type'];
    }

    public function labels(): array
    {
        return [
            'email'            => 'Email',
            'password'         => 'Password',
            'confirm_password' => 'Confirm Password',
            'type'             => "Type"
        ];
    }

    /**
     * @throws Exception
     */
    function getUserByEmail(string $email)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "SELECT * FROM user WHERE email = :email"
        );
        $statement->bindParam(":email", $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $user = null;
        if ($statement->rowCount() > 0) {
            $user = $statement->fetch();
        }
        DbConnection::dbClose();
        return $user;
    }

    /**
     * @throws Exception
     */
    function getUserById(int $id)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM user WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $user = null;
        if ($statement->rowCount() > 0) {
            $user = $statement->fetch();
        }
        DbConnection::dbClose();
        return $user;
    }

    /**
     * @throws Exception
     */
    function createUser($email, $password, $type = 'user')
    {
        $md5Password = md5($password);
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "INSERT INTO user (type, email, password) VALUES (:type,:email,:password)"
        );
        $statement->bindParam(":type", $type);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $md5Password);
        $statement->execute();
        $insertedId = $client->lastInsertId();
        $user = $this->getUserById($insertedId);
        DbConnection::dbClose();
        return $user;
    }

    /**
     * @throws Exception
     */
    function registration()
    {
        $user = $this->getUserByEmail($this->email);
        if (isset($user)) {
            throw new Exception("Already registered");
        } else {
            return $this->createUser(
                $this->email,
                $this->password,
                $this->type
            );
        }
    }

    /**
     * @throws Exception
     */
    function login()
    {
        $existingUser = $this->getUserByEmail($this->email);
        if (isset($existingUser)) {
            $encryptPassword = md5($this->password);
            if ($encryptPassword == $existingUser['password']) {
                return $existingUser;
            } else {
                throw  new Exception("Invalid email or password");
            }
        } else {
            throw  new Exception("No user exist");
        }
    }
}