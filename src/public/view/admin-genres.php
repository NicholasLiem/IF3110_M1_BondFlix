<?php
$pageTitle = 'Genre Dashboard';
$stylesheet = '/public/css/admin-genres.css';
$script = 'admin-genres.js';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];
?>

<link rel="stylesheet" href="/public/css/admin-page.css">
<link rel="stylesheet" href="/public/css/admin-genres.css">
<?php include $adminSidebarTemplate ?>

<body>
<div class="content">
    <div class="container">
        <form>
            <label for="edit_genre_id">Select a Genre to Edit:</label>
            <select name="edit_genre_id" id="edit_genre_id">
                <option value="test">test</option>
            </select>
            <input type="submit" value="Edit Genre">
        </form>
        <form id="add-new-genre-form">
            <label for="new_genre">Add New Genre:</label>
            <input type="text" name="new_genre" id="input-genre" required>
            <input type="submit" id= "submit-new-genre" value="Add Genre">
        </form>
    </div>
</div>
<script src="/public/js/admin-genres.js">
    document.getElementById('add-new-genre-form').addEventListener('submit', addNewGenre);
</script>
</body>
