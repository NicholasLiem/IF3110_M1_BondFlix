<?php
namespace Database;

use PDO;
use PDOException;

include "schema.php";

class Connection {

    private static $dbInstance = null;


    private function __construct(){}

    public static function getDBInstance() {
        if (self::$dbInstance === null) {
            self::$dbInstance = self::connectDB();
        }
        return self::$dbInstance;
    }

    private static function connectDB(){
        try {
            $dbhost = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $dbport = getenv('DB_PORT');
            $dbuser = getenv('DB_USER');
            $dbpass = getenv('DB_PASS');
            
            $db = new PDO("pgsql:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpass);
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