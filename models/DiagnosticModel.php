<?php

namespace app\models;

use app\base\DbConnection;
use app\base\Model;
use Exception;
use PDO;

class DiagnosticModel extends Model
{
    public string $name;
    public int $location_id;
    public string $hotline;
    public string $facebook;
    public string $website;

    public function attributes(): array
    {
        return ['name', 'location_id', 'hotline', 'facebook', 'website'];
    }

    public function labels(): array
    {
        return [
            "name"        => "Diagnostic Name",
            "location_id" => "Location",
            "hotline"     => "Hotline number",
            "facebook"    => "Facebook",
            "website"     => "Website address"
        ];
    }

    public function rules(): array
    {
        return [
            "name"        => [self::RULE_REQUIRED],
            "location_id" => [self::RULE_REQUIRED]
        ];
    }

    /**
     * @throws Exception
     */
    function getDiagnostic(int $id)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "SELECT * FROM diagnostic WHERE id = :id"
        );
        $statement->bindParam("id", $id);
        $statement->execute();
        $diagnostic = $statement->fetch(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $diagnostic;
    }

    /**
     * @throws Exception
     */
    function getDiagnostics()
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM diagnostic");
        $statement->execute();
        $diagnostics = $statement->fetchAll(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $diagnostics;
    }

}