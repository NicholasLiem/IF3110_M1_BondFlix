<?php
?>

<nav class="navbar">
    <div>
        <a href="/dashboard"><img class="logo" src="/public/logo.png" alt="Bondflix logo"></a>
        <div id="menu-left">
            <a href="">My List</a>
            <a href="">Movies</a>
            <a href="">TV Shows</a>
        </div>
    </div>
    <div id="menu-right">
        <input type="text" class="search-bar" placeholder="Search a movie">
        <button class="account-button">
            <img src="/public/avatar.png" alt="profile picture">
        </button>
        <div class="account-menu">
            <ul>
                <li>
                    <a href="/account">Account</a>
                </li>
                <li>
                    <a href="" onclick="logout()">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="/public/js/admin-sidebar.js"></script>
