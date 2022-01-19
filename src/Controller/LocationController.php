<?php

namespace DoctorAppointment\Controller;

use DoctorAppointment\DB\DbConnection;
use Exception;
use PDO;

class LocationController
{
    /**
     * @throws Exception
     */
    function getLocation(int $id)
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM location WHERE id = :id");
        $statement->bindParam("id", $id);
        $statement->execute();
        $location = $statement->fetch(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $location;
    }

    /**
     * @throws Exception
     */
    function getLocations()
    {
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("SELECT * FROM location");
        $statement->execute();
        $locations = $statement->fetchAll(PDO::FETCH_ASSOC);
        DbConnection::dbClose();
        return $locations;
    }

    /**
     * @throws Exception
     */
    function insertLocation($params)
    {
        $division = $params["division"];
        $district = $params["district"];
        $streetAddress = $params["street_address"];
        if (empty($division)) {
            throw new Exception("District field required");
        }
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "INSERT INTO location(divistion, district, street_address) VALUES (:division,:district,:street_address)"
        );
        $statement->bindParam("division", $division);
        $statement->bindParam("district", $district);
        $statement->bindParam("street_address", $streetAddress);
        $statement->execute();
        $lastInsertId = $client->lastInsertId();
        $location = $this->getLocation($lastInsertId);
        DbConnection::dbClose();
        return $location;
    }

    /**
     * @throws Exception
     */
    function updateLocation(int $id, $params): string
    {
        if ($id <= 0) {
            return "Invalid location id";
        }
        $division = $params["division"];
        $district = $params["district"];
        $streetAddress = $params["street_address"];
        if (empty($division)) {
            throw new Exception("District field required");
        }
        $client = DbConnection::dbConnect();
        $statement = $client->prepare(
            "UPDATE location SET divistion = :division, district = :district, street_address=:street_address WHERE id = :id"
        );
        $statement->bindParam("division", $division);
        $statement->bindParam("district", $district);
        $statement->bindParam("street_address", $streetAddress);
        $statement->bindParam("id", $id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $msg = "Location updated successfully";
        } else {
            $msg = "No location found by given id";
        }
        DbConnection::dbClose();
        return $msg;
    }

    /**
     * @throws Exception
     */
    function deleteLocation(int $id)
    {
        if ($id <= 0) {
            return "Invalid location id";
        }
        $client = DbConnection::dbConnect();
        $statement = $client->prepare("DELETE FROM location WHERE id = :id");
        $statement->bindParam("id", $id);
        $statement->execute();
        if ($statement->rowCount() > 0) {
            $msg = "Location deleted successfully";
        } else {
            $msg = "No location found by given id";
        }
        DbConnection::dbClose();
        return $msg;
    }
}