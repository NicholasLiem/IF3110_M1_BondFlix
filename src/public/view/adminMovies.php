<?php
$adminSidebarTemplate = BASE_PATH . "/public/templates/adminSidebar.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movies</title>
    <link rel="stylesheet" href="/public/css/admin-page.css">
    <link rel="stylesheet" href="/public/css/admin-sidebar.css">
    <link rel="stylesheet" href="/public/css/admin-movies.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap"
      rel="stylesheet"
    />
  </head>
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
</html>