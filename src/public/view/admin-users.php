<?php
$pageTitle = 'User Dashboard';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>
    <link rel="stylesheet" href="/public/css/admin-page.css">
    <link rel="stylesheet" href="/public/css/admin-table.css">
    <script src="/public/js/admin-users.js" defer></script>
    <body>
        <?php
        include $adminSidebarTemplate
        ?>
        <main>
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
        </main>
    </body>
</html>