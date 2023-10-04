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
<body>
<?php include $adminSidebarTemplate ?>
<div class="content">
    <div class="container">
        <div class="genre-container">
            <h2>Manage Genre</h2>
            <table class="manage-genre-table">
                <tr>
                    <th><label for="edit_genre_id">Select a Genre to Edit</label></th>
                    <th><select name="edit_genre_id" id="edit_genre_id">
                            <option value="test">test</option>
                        </select></th>
                    <th><input type="submit" value="Edit Genre"></th>
                </tr>
                <tr>
                    <th><label>Add New Genre</label></th>
                    <th><input type="text" name="genre_name" id="input-genre" required</th>
                    <th><input type="submit" id="submit-new-genre" value="Add Genre"></th>
                </tr>
            </table>
        </div>
        <div class="category-container">
            <h2>Manage Genre</h2>
            <table class="manage-genre-table">
                <tr>
                    <th><label for="edit_genre_id">Select a Genre to Edit</label></th>
                    <th><select name="edit_genre_id" id="edit_genre_id">
                            <option value="test">test</option>
                        </select></th>
                    <th><input type="submit" value="Edit Genre"></th>
                </tr>
                <tr>
                    <th><label>Add New Genre</label></th>
                    <th><input type="text" name="genre_name" id="input-genre" required</th>
                    <th><input type="submit" id="submit-new-genre" value="Add Genre"></th>
                </tr>
            </table>
        </div>
        <div class="actor-container">
            <h2>Manage Actor</h2>
            <table class="manage-genre-table">
                <tr>
                    <th><label for="edit_genre_id">Select a Genre to Edit</label></th>
                    <th><select name="edit_genre_id" id="edit_genre_id">
                            <option value="test">test</option>
                        </select></th>
                    <th><input type="submit" value="Edit Genre"></th>
                </tr>
                <tr>
                    <th><label>Add New Genre</label></th>
                    <th><input type="text" name="genre_name" id="input-genre" required</th>
                    <th><input type="submit" id="submit-new-genre" value="Add Genre"></th>
                </tr>
            </table>
        </div>
    </div>
</div>


<script src="/public/js/admin-media-management.js"></script>
<script>
    document.getElementById('add-new-genre-form').addEventListener('submit', addNewGenre);
</script>
</body>
