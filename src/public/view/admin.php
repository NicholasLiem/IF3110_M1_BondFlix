<?php
    $pageTitle = 'Admin Dashboard';
    $stylesheet = '/public/css/admin-page.css';
    $script = 'admin.js';
    include BASE_PATH . "/public/templates/header.php";
    $adminSidebarTemplate = BASE_PATH . "/public/templates/admin-sidebar.php";
    $username = $_SESSION['username'];
?>

<body>
  <?php
  include $adminSidebarTemplate
  ?>
  <main>
    <p>Welcome to Admin Page, <?php echo $username ?>!</p>
  </main>
</body>
