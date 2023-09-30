<?php
$pageTitle = 'Movie Dashboard';
$stylesheet = '/public/css/admin-movies.css';
$script = 'admin.js';
include BASE_PATH . "/public/templates/header.php";
$adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
$username = $_SESSION['username'];

?>

<link rel="stylesheet" href="/public/css/admin-page.css">
  <body>
    <?php
    include $adminSidebarTemplate
    ?>
    <main>
      <a href="/adminPage/movies/upload">Upload</a>
      <table>
        <tr>
          <th>No.</th>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Release Date</th>
          <th>Content File Path</th>
          <th>Action</th>
        </tr>
        <tr>
          <td>1</td>
          <td>1</td>
          <td>Upin Ipin</td>
          <td>Bocah kembar</td>
          <td>01 Januari 2000</td>
          <td>/file/upinipin.mp4</td>
          <td>
            <button>Edit</button>
            <button>Delete</button>
          </td>
        </tr>
      </table>
    </main>
  </body>