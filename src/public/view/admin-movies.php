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
<script src="/public/js/admin-movies.js" defer></script>
<?php include $adminSidebarTemplate ?>

<body>
    <div class="content">
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search...">
            <button id="search-button" class="search-bar-button">Search</button>
            <button id="refresh-button" class="search-bar-button">Refresh</button>
        </div>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Release Date</th>
                <th>Content File Path</th>
                <th>Thumbnail File Path</th>
                <th>Action</th>
            </tr>
        </table>
        <div id="editContentModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Content</h2>
                <table class="edit-content-modal">
                    <tr>
                        <td><label for="editTitle">Title</label></td>
                        <td><input type="text" id="editTitle" name="title" required></td>
                    </tr>
                    <tr>
                        <td><label for="editDescription">Description</label></td>
                        <td><textarea name="description" id="editDescription" cols="30" rows="10" required></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="editReleaseDate">Release Date</label></td>
                        <td><input type="date" id="editReleaseDate" name="releaseDate" required></td>
                    </tr>
                    <tr>
                        <td><label for="editContentFilePath">Content File Path</label></td>
                        <td><input type="text" id="editContentFilePath" name="contentFilePath" required></td>
                    </tr>
                    <tr>
                        <td><label for="editThumbnailFilePath">Thumbnail File Path</label></td>
                        <td><input type="text" id="editThumbnailFilePath" name="thumbnailFilePath" required></td>
                    </tr>
                </table>
                <button type="submit" class="submit-edit" id="saveEditButton">Save</button>
            </div>
        </div>
    </div>
</body>
