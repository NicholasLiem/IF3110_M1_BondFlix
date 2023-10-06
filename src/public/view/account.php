<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$isAdmin = $_SESSION['is_admin'];
$isSubscribed = $_SESSION['is_subscribed'];
$pageTitle = 'User Account';

if ($isSubscribed) {
    $isSubscribed = "Active";
} else {
    $isSubscribed = "Not Active";
}
include BASE_PATH . "/public/templates/header.php";
?>

<link rel="stylesheet" href="/public/css/account.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap"
  rel="stylesheet"
/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Roboto:wght@700&display=swap" rel="stylesheet">
<script src="/public/js/navbar.js" defer></script>

<body>
    <?php
        include BASE_PATH . '/public/templates/navbar.php'
    ?>
    <main>
        <div id="account-settings-container">
            <div><h1>Account Settings </h1></div>
            <div><h2>Hello, <?php echo $first_name . ' ' . $last_name ?></h2></div>
            <div id="account-settings-content">
                <div>
                    <img src="/public/avatar.png" alt="profile-picture" id="profile-picture">
                    <button id="edit-profile-pic-button">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                        </svg>
                    </button>
                </div>
                <div>
                    <ul>
                        <li>
                            <label for="username">Username</label>
                            <input type="text" id="username" name="user-name" class="text-input" placeholder="<?php echo $username ?>" disabled>
                        </li>
                        <li>
                            <label for="username">Subscription Status</label>
                            <input type="text" id="username" name="user-name" class="text-input" placeholder="<?php echo $isSubscribed ?>" disabled>
                        </li>
                        <li>
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" class="text-input" placeholder="Current First Name">
                        </li>
                        <li>
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" class="text-input" placeholder="Current Last Name">
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="text-input" placeholder="Change password">
                        </li>
                    </ul>
                </div>
            </div>
            <div id="account-settings-buttons">
                <button id="save-button">SAVE</button>
                <button id="cancel-button">CANCEL</button>
            </div>
        </div>
    </main>
    <script src="/public/js/account.js"></script>
</body>
