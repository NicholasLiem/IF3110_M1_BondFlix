<?php
?>

<link rel="stylesheet" href="/public/css/admin-sidebar.css">
<script src="/public/js/admin-sidebar.js"></script>
<nav class="admin-sidebar" id="sidebar">
    <ul>
        <li><a href="/admin"><img src="/public/logo.png" alt="Bondflix logo" class="logo-img"/></a></li>
        <li><a href="/admin/users"><div class="sidebar-item">Users</div></a></li>
        <li><a href="/admin/movies"><div class="sidebar-item">Movies</div></a></li>
        <li><a href="#"><div class="sidebar-item">Genre</div></a></li>
        <li><a href="#"><div class="sidebar-item">Categories</div></a></li>
        <li><a href="#"><div class="sidebar-item">Actors</div></a></li>
        <li><a href="#"><div class="sidebar-item">Directors</div></a></li>
        <li><a onclick="logout()"><div class="sidebar-item">Logout</div></a></li>
    </ul>
</nav>
