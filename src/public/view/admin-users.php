<?php
$pageTitle = 'User Dashboard';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="/public/css/admin-page.css">
<link rel="stylesheet" href="/public/css/admin-table.css">
<link rel="stylesheet" href="/public/css/admin-users.css"
<?php include $adminSidebarTemplate ?>
<body>
<div class="content">
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Admin Status</th>
            <th>Subscription</th>
            <th>Action</th>
        </tr>
    </table>
</div>
<script src="/public/js/admin-users.js"></script>
</body>
