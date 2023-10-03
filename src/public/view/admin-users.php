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
            <input type="text" id="search-input" placeholder="Search by username, first name, or last name">
            <button id="sort-button" class="search-bar-button">Sort ID ↑</button>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Admin</th>
                    <th>Subscribed</th>
                    <th>Menu</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
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
