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
            <input type="text" id="search-input" placeholder="Search by title">
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
                <th>Content File Name</th>
                <th>Thumbnail File Name</th>
                <th>Menu</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="pagination">
            <button id="prevPageButton">◄</button>
            <button id="currentPageButton">1</button>
            <button id="nextPageButton">►</button>
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
                </table>
                <button type="submit" class="submit-edit" id="saveEditButton">Save</button>
            </div>
        </div>
        <div id="new-content-modal" class="modal">
            <div class="modal-content">
                <span class="close" id="close-new-content-modal">&times;</span>
                <h2>New Content</h2>
                <form id="upload-form" enctype="multipart/form-data">
                    <table class="new-content-modal">
                        <tr>
                            <td><label for="movie-title">Title</label></td>
                            <td><input type="text" name="title" id="movie-title" required/></td>
                        </tr>
                        <tr>
                            <td><label for="movie-description">Description</label></td>
                            <td><textarea
                                        name="description"
                                        id="movie-description"
                                        cols="auto"
                                        rows="5"
                                ></textarea></td>
                        </tr>
                        <tr>
                            <td><label for="movie-release-date">Release Date</label></td>
                            <td><input
                                        type="date"
                                        name="release-date"
                                        id="movie-release-date"
                                        required
                                /></td>
                        </tr>
                        <tr>
                            <td><label for="movie-thumbnail">Thumbnail</label></td>
                            <td><input type="file" name="thumbnail" id="movie-thumbnail" required />
                            </td>
                        </tr>
                        <tr>
                            <td><label for="movie-video">Video</label></td>
                            <td><input type="file" name="video" id="movie-video" required /></td>
                        </tr>
                    </table>
                    <button type="submit" id="submit-new-content-button">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/public/js/admin-movies.js"></script>
</body>
