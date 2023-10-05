<?php
$pageTitle = 'Movie Dashboard';
$stylesheet = '/public/css/admin-movies.css';
$script = 'admin.js';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="/public/css/admin-page.css">
<link rel="stylesheet" href="/public/css/admin-table.css">
<link rel="stylesheet" href="/public/css/admin-movies.css">
<?php include $adminSidebarTemplate ?>
<body>
    <div class="content">
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search by title...">
            <button id="sort-button" class="search-bar-button">Sort Title ↑</button>
            <button id="enable-filter-button" class="search-bar-button">Filter Disabled ✗</button>
            <button id="add-content-button" class="search-bar-button">New Content</button>
        </div>

        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Release Date</th>
                <th>Content File Path</th>
                <th>Thumbnail File Path</th>
                <th>Menu</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="pagination">
            <button id="prevPageButton">Previous</button>
            <button id="nextPageButton">Next</button>
        </div>

        <div id="editUserModal" class="modal">
            <div class="modal-content">
                <span class="close" id="close-edit">&times;</span>
                <h2>Edit User</h2>
                <table class="edit-user-modal">
                    <tr>
                        <td><label for="editUsername">Username</label></td>
                        <td><input type="text" id="editUsername" name="username" disabled="disabled" required></td>
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
                        <td><label for="editPassword">New Password</label></td>
                        <td><input type="password" id="editPassword" name="password"></td>
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
        <div id="newUserModal" class="modal">
            <div class="modal-content">
                <span class="close" id="close-user">&times;</span>
                <h2>New Content</h2>
                <table class="new-user-modal">
                    <tr>
                        <td><label for="newUsername">Username</label></td>
                        <td><input type="text" id="newUsername" name="username" required></td>
                    </tr>
                    <tr>
                        <td><label for="newFirstName">First Name</label></td>
                        <td><input type="text" id="newFirstName" name="firstName" required></td>
                    </tr>
                    <tr>
                        <td><label for="newLastName">Last Name</label></td>
                        <td><input type="text" id="newLastName" name="lastName"></td>
                    </tr>
                    <tr>
                        <td><label for="newPassword">Password</label></td>
                        <td><input type="password" id="newPassword" name="password"></td>
                    </tr>
                    <tr>
                        <td><label for="newPasswordConfirmation">Password Confirmation</label></td>
                        <td><input type="password" id="newPasswordConfirmation" name="passwordConfirmation"></td>
                    </tr>
                </table>
                <button type="submit" class="submit-new-content" id="newContentButton">Add Content</button>
            </div>
        </div>
    </div>
    <script src="/public/js/admin-movies.js"></script>
</body>
