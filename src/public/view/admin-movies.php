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
            <button id="currentPageButton">1</button>
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
                </table>
                <button type="submit" class="submit-edit" id="saveEditButton">Save</button>
            </div>
        </div>
        <div id="new-content-modal" class="modal">
            <div class="modal-content">
                <span class="close" id="close-new-content-modal">&times;</span>
                <h2>Edit Movie</h2>
                <form id="upload-form" enctype="multipart/form-data">
                    <div>
                        <label for="movie-title">Title</label>
                        <input type="text" name="title" id="movie-title" required/>
                    </div>
                    <div>
                        <label for="movie-description">Description</label>
                        <textarea
                                name="description"
                                id="movie-description"
                                cols="30"
                                rows="10"
                        ></textarea>
                    </div>
                    <div>
                        <label for="movie-release-date">Release Date</label>
                        <input
                                type="date"
                                name="release-date"
                                id="movie-release-date"
                                required
                        />
                    </div>
                    <div>
                        <label for="movie-thumbnail">Thumbnail</label>
                        <input type="file" name="thumbnail" id="movie-thumbnail" required />
                    </div>
                    <div>
                        <label for="movie-video">Video</label>
                        <input type="file" name="video" id="movie-video" required />
                    </div>
                    <button type="submit" id="submit-new-content-button">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <script src="/public/js/admin-movies.js"></script>
</body>
