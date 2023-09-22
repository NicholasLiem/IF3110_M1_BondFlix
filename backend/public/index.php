<?php

try {
    $dbhost = 'postgres-db';
    $dbname = 'wbd_data';
    $dbport = '5432';
    $dbuser = 'wbdasik';
    $dbpass = 'wbdasikbossq';

    $pdo = new PDO("pgsql:host=$dbhost;port=$dbport;dbname=$dbname", $dbuser, $dbpass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $stmt = $pdo->query("SELECT * FROM testing");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: {$row['test']}, Name: {$row['test']}<br>";
    }

} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}

?>
