<?php

namespace DoctorAppointment\Controller;

use DoctorAppointment\DB\DbConnection;
use Exception;
use PDO;

class UserController
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    function getUserByEmail(string $email)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM user WHERE email = :email");
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
        $statement = $client->prepare("INSERT INTO user (type, email, password) VALUES (:type,:email,:password)");
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
    function registration($email, $password, $type = 'user')
    {
        $user = $this->getUserByEmail($email);
        if (isset($user)) {
            throw new Exception("Already registered");
        } else {
            return $this->createUser($email, $password, $type);
        }
    }

    /**
     * @throws Exception
     */
    function login($email, $password)
    {
        $existingUser = $this->getUserByEmail($email);
        if (isset($existingUser)) {
            $encryptPassword = md5($password);
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