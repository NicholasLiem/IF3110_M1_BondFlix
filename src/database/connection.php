<?php
include "schema.php";

function ConnectDB() {
    global $users;
    try {
        $dbhost = 'postgres-db';
        $dbname = 'wbd_data';
        $dbport = '5432';
        $dbuser = 'wbdasik';
        $dbpass = 'wbdasikbossq';

        $db = new PDO("pgsql:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec($users);

        echo "Database successfully connected\n";
        return $db;
    } catch (PDOException $e) {
        die("Connection failed" . $e->getMessage());
    }
}


//CREATE TABLE roles (
//    --     role_id SERIAL PRIMARY KEY,
//--     role_name VARCHAR(20) UNIQUE NOT NULL
//-- );
//--
//-- INSERT INTO roles (role_name) VALUES ('user'), ('admin');
//--
//--
//-- CREATE TABLE user_roles (
//    --     user_id INT REFERENCES users(user_id),
//--     role_id INT REFERENCES roles(role_id),
//--     PRIMARY KEY (user_id, role_id)
//-- );
//--
//-- INSERT INTO user_roles (user_id, role_id)
//-- SELECT user_id, role_id FROM users WHERE username = 'admin';