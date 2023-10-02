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
    <div class="search-bar">
        <input type="text" id="search-input" placeholder="Search...">
        <button id="search-button" class="search-bar-button">Search</button>
<!--        <button id="sort-button" class="search-bar-button">-->
<!--            <span class="sort-text">Sort</span>-->
<!--            <span class="arrow-down"></span>-->
<!--        </button>-->
<!--        <div class="dropdown filter-dropdown search-bar-button">-->
<!--            <button id="filter-button" class="filter-button">-->
<!--                <span class="filter-text">Filter</span>-->
<!--                <span class="arrow-down"></span>-->
<!--            </button>-->
<!--            <div class="dropdown-content filter-dropdown-content">-->
<!--                <a href="#">Option 1</a>-->
<!--                <a href="#">Option 2</a>-->
<!--                <a href="#">Option 3</a>-->
<!--            </div>-->
<!--        </div>-->
        <button id="refresh-button" class="search-bar-button">Refresh</button>
    </div>
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
