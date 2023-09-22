<?php
require 'Database/connection.php';

$db = Database\Connection::getDBInstance();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['route'] === 'user') {
        $action = $_GET['action'];
        $userId = $_GET['id'];

        if ($action === 'get') {
            $stmt = $db->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                echo "User ID: " . $user['user_id'] . "<br>";
                echo "Username: " . $user['username'] . "<br>";
            } else {
                echo "User not found";
            }
        }
    }
}
