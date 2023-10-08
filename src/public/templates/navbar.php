<?php
?>
<link rel="stylesheet" href="/public/css/lib/index/navbar.css">
<nav class="navbar">
    <div>
        <a href="/dashboard"><img class="logo" src="/public/logo.png" alt="Bondflix logo"></a>
        <div id="menu-left">
            <a href="/mylist">My List</a>
            <a href="/dashboard">Movies</a>
        </div>
    </div>
    <div id="menu-right">
        <input type="text" class="search-bar" placeholder="Search a movie" id="navbar-search-input">
        <div class="filter-container">
            <select id="genre-dropdown">
            </select>
            <input type="date" id="release-date-filter" title="Release Date">
            <button class="filter-button" >Filter</button>
        </div>
        <button class="navbar-account-button">
            <img src="/public/avatar.png" id='profile-picture-navbar' alt="profile picture">
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
<script src="/public/js/navbar.js"></script>
