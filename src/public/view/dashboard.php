<?php

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

$userID = $_SESSION['user_id'];
$username = $_SESSION['username'];
$isAdmin = $_SESSION['is_admin'];

$pageTitle = 'User Dashboard';
include BASE_PATH . "/public/templates/header.php";
?>

<link rel="stylesheet" href="/public/css/dashboard.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Mono&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<body>
    <nav class="navbar">
        <div>
            <a href="/"><img class="logo" src="/public/logo.png" alt="Bondflix logo"></a>
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
        </div>
    </nav>
    <main>
        <div id="most-recommended">
            <div class="description-card">
                <h2>
                    Movie Title
                </h2>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit impedit ea, totam saepe quibusdam assumenda ducimus tempora aliquam! Nostrum animi quis cupiditate autem commodi placeat delectus facilis eum saepe dolor.
                </p>
                <div>
                    <button>Play</button>
                    <button>More Info</button>
                </div>
            </div>
        </div>
    </main>
    <!-- <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($username); ?></h1>
    <p>User ID: <?php echo htmlspecialchars($userID); ?></p>
    <p>Username: <?php echo htmlspecialchars($username); ?></p>
    <p>Is Admin: <?php echo $isAdmin ? 'Yes' : 'No'; ?></p>


    <a href="logout">Logout</a> -->
</body>
