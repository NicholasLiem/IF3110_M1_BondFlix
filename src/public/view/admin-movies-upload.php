<?php
$pageTitle = 'Movie Upload Dashboard';
$stylesheet = '/public/css/admin-upload.css';
$script = 'admin.js';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="/public/css/admin-page.css">
<link rel="stylesheet" href="/public/css/admin-movies-upload.css">
<script src="/public/js/admin-movies-upload.js" defer></script>

<?php include $adminSidebarTemplate ?>
<body>
    <div id="upload-form-container">
        <form id="upload-form" enctype="multipart/form-data">
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="movie-title" required/>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea
                        name="description"
                        id="movie-description"
                        cols="30"
                        rows="10"
                        
                ></textarea>
            </div>
            <div>
                <label for="release-date">Release Date</label>
                <input
                        type="date"
                        name="release-date"
                        id="movie-release-date"
                        required
                />
            </div>
            <div>
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="movie-thumbnail" required />
            </div>
            <div>
                <label for="video">Video</label>
                <input type="file" name="video" id="movie-video" required />
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>
