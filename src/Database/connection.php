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
            $dbhost = 'postgres-db';
            $dbname = 'wbd_data';
            $dbport = '5432';
            $dbuser = 'wbdasik';
            $dbpass = 'wbdasikbossq';

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