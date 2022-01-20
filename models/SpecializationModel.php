<?php

namespace app\models;

use app\base\DbConnection;
use app\base\Model;
use Exception;
use PDO;

class SpecializationModel extends Model
{
    public string $name;
    public string $remark;

    public function attributes(): array
    {
        return ['name', 'remark'];
    }

    public function labels(): array
    {
        return [
            'name'   => "Specialization name",
            'remark' => "Remark"
        ];
    }

    public function rules(): array
    {
        return [
            "name" => [self::RULE_REQUIRED]
        ];
    }

    /**
     * @throws Exception
     */
    function getSpecialization(int $id)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "SELECT * FROM specialization WHERE id = :id"
        );
        $statement->bindParam(":id", $id);
        $specialization = $statement->fetch(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $specialization;
    }

    /**
     * @throws Exception
     */
    function getSpecializations()
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM specialization");
        $specializations = $statement->fetchAll(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $specializations;
    }

    /**
     * @throws Exception
     */
    function insertSpecialization(string $name, string $remark = null)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "INSERT INTO specialization (name,remark) VALUES  (:name,:remark)"
        );
        $statement->bindParam(":name", $name);
        $statement->bindParam(":remark", $remark);
        $statement->execute();
        $lastInsertedId = $client->lastInsertId();
        $specialization = $this->getSpecialization($lastInsertedId);
        DbConnection::dbClose();
        return $specialization;
    }

    /**
     * @throws Exception
     */
    function updateSpecialization(int $id, string $name, string $remark): string
    {
        if ($id > 0) {
            $client = DbConnection::dbConnect();
            $statement = $client->prepare(
                "UPDATE specialization SET name = :name, remark=:remark WHERE id = :id"
            );
            $statement->bindParam("name", $name);
            $statement->bindParam("remark", $remark);
            $statement->bindParam("id", $id);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $msg = "Specialization updated successfully";
            } else {
                $msg = "No specialization found by given id";
            }
            DbConnection::dbClose();
            return $msg;
        } else {
            throw new Exception("Invalid id provided");
        }
    }

    /**
     * @throws Exception
     */
    function deleteSpecialization(int $id): string
    {
        if ($id > 0) {
            $client = DbConnection::dbConnect();
            $statement = $client->prepare(
                "DELETE FROM specialization WHERE id = :id"
            );
            $statement->bindParam("id", $id);
            $statement->execute();
            if ($statement->rowCount() > 0) {
                $msg = "Specialization deleted successfully";
            } else {
                $msg = "No specialization found by given id";
            }
            DbConnection::dbClose();
            return $msg;
        } else {
            throw new Exception("Invalid id provided");
        }
    }
}