<?php
namespace Database;

use PDO;
use PDOException;

include "Schema.php";
class Connection {
    private static ?PDO $dbInstance = null;
    private function __construct(){}
    public static function getDBInstance(): ?PDO
    {
        if (self::$dbInstance === null) {
            self::$dbInstance = self::connectDB();
        }
        return self::$dbInstance;
    }

    private static function connectDB(){
        try {

            $db_host = getenv('DB_HOST');
            $db_name = getenv('DB_NAME');
            $db_port = getenv('DB_PORT');
            $db_user = getenv('DB_USER');
            $db_pass = getenv('DB_PASS');

            $db = new PDO("pgsql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::migrate($db);
            return $db;
        } catch (PDOException $e) {
            die("Connection failed" . $e->getMessage());
        }
    }

    private static function migrate($db) {
        $usersTableSchema = Schema::$usersTableSchema;
        $mediaTableSchema = Schema::$mediaTableSchema;

        $schemas = [$usersTableSchema, $mediaTableSchema];

        foreach ($schemas as $schema) {
            $db->exec($schema);
        }
    }
}