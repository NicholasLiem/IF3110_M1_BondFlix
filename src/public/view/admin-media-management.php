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
                    <th><label for="edit_genre_id">Select a Genre to Edit</label></th>
                    <th>
                        <select name="edit_genre_id" id="edit_genre_id">
                            
                        </select>
                    </th>
                    <th><button id="edit_genre_button">Edit Genre</button></th>
                </tr>
                <tr>
                    <th><label for="input-genre">Add New Genre</label></th>
                    <th><input type="text" name="genre_name" id="input-genre" required</th>
                    <th><button id="add-genre-button">Add Genre</button></th>
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
        <div class="category-container">
            <h2>Manage Category</h2>
            <table class="manage-table">
                <tr>
                    <th><label for="edit_category_id">Select a Category to Edit</label></th>
                    <th><select name="edit_category_id" id="edit_category_id">
                            <option value="test">test</option>
                        </select></th>
                    <th><button id="edit_category_button">Edit Category</button></th>
                </tr>
                <tr>
                    <th><label for="category-name">Add New Category</label></th>
                    <th><input type="text" name="category_name" id="category-name" required</th>
                    <th><button id="add-category-button">Add Category</button></th>
                </tr>
            </table>
            <div id="editCategoryModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Category</h2>
                    <table class="edit-category-modal">
                        <tr>
                            <td><label for="editCategoryName">New category name</label></td>
                            <td><input type="text" id="editCategoryName" name="categoryName" required></td>
                        </tr>
                    </table>
                    <button type="submit" class="submit-edit" id="saveEditCategoryButton">Save</button>
                </div>
            </div>
        </div>
        <div class="actor-container">
            <h2>Manage Actor</h2>
            <table class="manage-table">
                <tr>
                    <th><label for="edit_actor_id">Select an Actor to Edit</label></th>
                    <th><select name="edit_actor_id" id="edit_actor_id">
                            <option value="test">test</option>
                        </select></th>
                    <th><button id="edit_actor_button">Edit Actor </button></th>
                </tr>
                <tr>
                    <th><button id="add-actor-button">Add new actor</button></th>
                </tr>
            </table>
            <div id="editActorModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Actor</h2>
                    <table class="edit-actor-modal">
                        <tr>
                            <td><label for="editActorFirstName">Actor first name</label></td>
                            <td><input type="text" id="editActorFirstName" name="actorFirstName" required></td>
                        </tr>
                        <tr>
                            <td><label for="editActorLastName">Actor last name</label></td>
                            <td><input type="text" id="editActorLastName" name="actorLastname"></td>
                        </tr>
                        <tr>
                            <td><label for="editActorBirthDate">Actor birth date</label></td>
                            <td><input type="date" id="editActorBirthDate" name="actorBirthDate"></td>
                        </tr>
                        <tr>
                            <td><label for="editActorGender">Actor gender</label></td>
                            <td><input type="text" id="editActorGender" name="actorGender"></td>
                        </tr>
                    </table>
                    <button type="submit" id="saveEditActorButton">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>
    document.getElementById('add-new-genre-form').addEventListener('submit', addNewGenre);
</script> -->
</body>
