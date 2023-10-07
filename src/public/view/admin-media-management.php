<?php
$pageTitle = 'Media Management';
$stylesheet = '/public/css/admin-genres.css';
$script = 'admin-genres.js';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="/public/css/admin-page.css">
<link rel="stylesheet" href="/public/css/admin-media-management.css">
<script src="/public/js/admin-media-management.js" defer></script>


<body>
<?php include $adminSidebarTemplate ?>
<div class="content">
    <div class="container">
        <div class="genre-container">
            <h2>Manage Genre</h2>
            <table class="manage-table">
                <tr>
                    <td><label for="edit_genre_id">Select a Genre to Edit</label></td>
                    <td>
                        <select name="edit_genre_id" id="edit_genre_id" required>
                        </select>
                    </td>
                    <td><button id="edit_genre_button" type="submit">Edit Genre</button></td>
                    <td><button id="delete_genre_button" type="submit">Delete Genre</button></td>
                </tr>
                <tr>
                    <form id="add-genre-form">
                        <td><label for="input-genre">Add New Genre</label></td>
                        <td><input type="text" name="genre_name" id="input-genre" required></td>
                        <td><button type="submit" id="add-genre-button">Add Genre</button></td>
                    </form>
                </tr>
            </table>
            <div id="editGenreModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Genre</h2>
                    <table class="edit-genre-modal">
                        <tr>
                            <td><label for="editGenreName">New genre name</label></td>
                            <td><input type="text" id="editGenreName" name="genreName" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="submit-edit" id="saveEditGenreButton">Save</button>
                </div>
            </div>
        </div>
        <div id="content-genre-container">
            <h2>Manage content genre</h2>
            <form id="find-content-genre">
                <label for="content-id">content id</label>
                <input type="text" id="content-id" required />
                <button type="submit" id="find-content-genre">Find Genre</button>
            </form>
            <form id="add-new-content-genre">
                <select name="content-new-genre-dropdown" id="content-new-genre-dropdown" required>
                </select>
                <button type="submit" id="add-content-genre">Add Genre</button>
            </form>
            <table class="admin-table" id="content-genre-table">
                <tr>
                    <th>Genre ID</th>
                    <th>Genre Name</th>
                    <th>Delete</th>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
