<?php

namespace DoctorAppointment\Controller;

use DoctorAppointment\DB\DbConnection;
use Exception;
use PDO;

class DiagnosticController
{
    /**
     * @throws Exception
     */
    function getDiagnostic(int $id)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM diagnostic WHERE id = :id");
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