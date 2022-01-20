<?php

namespace app\base;

use Exception;
use PDO;

class DbConnection
{

    private static ?PDO $dbClient;

    /**
     * @throws Exception
     */
    public static function dbConnect(): ?PDO
    {
        try {
            $host = Config::DATABASE_HOST;
            $db = Config::DATABASE_NAME;
            $port = Config::DATABASE_PORT;
            self::$dbClient = new PDO(
                "mysql:host=$host;dbname=$db;port=$port",
                Config::DATABASE_USER_NAME,
                Config::DATABASE_PASSWORD
            );
            self::$dbClient->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        } catch (Exception $exception) {
            self::$dbClient = null;
        }
        return self::$dbClient;
    }

    public static function dbClose()
    {
        self::$dbClient = null;
    }
}