<?php
global $container;
require_once __DIR__ . '/../services.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['route']) && isset($_POST['action'])) {
    $route = $_POST['route'];
    $action = $_POST['action'];

    if ($route === 'user' && $action === 'login') {
        try {
            $userService = $container->resolve('userService');

            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $userService->login($username, $password);

            if ($user) {
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Login failed. Please check your credentials and try again.";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
</head>
<body>
<h1>User Login</h1>
<form method="POST" action="">
    <input type="hidden" name="route" value="user">
    <input type="hidden" name="action" value="login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
</form>
<?php
if (isset($error)) {
    echo '<p style="color: red;">' . $error . '</p>';
}
?>
</body>
</html>
