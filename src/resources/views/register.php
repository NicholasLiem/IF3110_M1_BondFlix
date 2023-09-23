<?php
global $container;
require_once __DIR__ . '/../../services.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['route']) && isset($_POST['action'])) {
    $route = $_POST['route'];
    $action = $_POST['action'];

    if ($route === 'user' && $action === 'register') {
        $userService = $container->resolve('userService');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $result = $userService->registerUser($username, $password, $email);

        if ($result) {
            header("Location: success.php");
            echo "Berhasil register";
            exit();
        } else {
            $error = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Registration</title>
</head>
<body>
<h1>User Registration</h1>
<form method="POST" action="">
    <input type="hidden" name="route" value="user">
    <input type="hidden" name="action" value="register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <input type="submit" value="Register">
</form>
</body>
</html>