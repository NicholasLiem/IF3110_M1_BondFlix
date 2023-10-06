<?php
$username = $_SESSION['username'];
?>

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="/public/css/admin-sidebar.css">
<script src="/public/js/admin-sidebar.js"></script>
<nav class="admin-sidebar" id="sidebar">
    <ul>
        <li><a href="/admin"><img src="/public/logo.png" alt="Bondflix logo" class="logo-img"/></a></li>
        <li><h3>Welcome, <?php echo $username ?></h3></li>
        <li><a href="/admin/users" ><div class="sidebar-item" id="users-item">Users</div></a></li>
        <li><a href="/admin/movies" ><div class="sidebar-item" id="movies-item">Movies</div></a></li>
        <li><a href="/admin/media/management" ><div class="sidebar-item" id="media-item">Media</div></a></li>
        <li><a href="/dashboard" ><div class="sidebar-item" id="dashboard-item">User Dashboard</div></a></li>
        <li><a onclick="logout()"><div class="sidebar-item">Logout</div></a></li>
    </ul>
</nav>
