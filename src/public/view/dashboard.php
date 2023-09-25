<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$isAdmin = $_SESSION['is_admin'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
<h1>Welcome to the Dashboard, <?php echo htmlspecialchars($username); ?></h1>
<p>User ID: <?php echo htmlspecialchars($userID); ?></p>
<p>Username: <?php echo htmlspecialchars($username); ?></p>
<p>Is Admin: <?php echo $isAdmin ? 'Yes' : 'No'; ?></p>


<a href="logout.php">Logout</a>
</body>
</html>
