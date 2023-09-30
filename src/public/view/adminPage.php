<?php
$adminSidebarTemplate = BASE_PATH . "/public/templates/adminSidebar.php";
//TODO: Get admin username from session
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin page</title>
    <link rel="stylesheet" href="/public/css/admin-page.css">
    <link rel="stylesheet" href="/public/css/admin-sidebar.css">
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
      <p>Welcome to Admin Page, username!</p>
    </main>
  </body>
</html>