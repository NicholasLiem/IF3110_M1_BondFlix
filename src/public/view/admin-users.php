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

        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Admin</th>
                <th>Subscribed</th>
                <th>Menu</th>
            </tr>
        </table>

        <div id="editUserModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit User</h2>
                <table class="edit-user-modal">
                    <tr>
                        <td><label for="editUsername">Username</label></td>
                        <td><input type="text" id="editUsername" name="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="editFirstName">First Name</label></td>
                        <td><input type="text" id="editFirstName" name="firstName" required></td>
                    </tr>
                    <tr>
                        <td><label for="editLastName">Last Name</label></td>
                        <td><input type="text" id="editLastName" name="lastName"></td>
                    </tr>
                    <tr>
                        <td><label for="editStatusAdmin">Admin Status</label></td>
                        <td><select id="editStatusAdmin" name="statusAdmin">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="editStatusSubscription">Subscription Status</label></td>
                        <td><select id="editStatusSubscription" name="statusSubscription">
                                <option value="true">Yes</option>
                                <option value="false">No</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="submit-edit" id="saveEditButton">Save</button>
            </div>
        </div>
    </div>
    <script src="/public/js/admin-users.js"></script>
</body>
