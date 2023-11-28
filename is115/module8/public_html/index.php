<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {

    include_once('../include/db.inc.php');
    include_once('../classes/database.php');

    $conn = new Database($pdo);
    $user = $conn->selectUserFromDBUserId($_SESSION['userID']);


    // Include the header, booking system template, and footer files
    include("../include/header.inc.php");

    // Check if the flash message cookie is set
    if (isset($_COOKIE['login_message'])) {
        // Display the flash message
        echo "<b>" . $_COOKIE['login_message'] . "</b><br>";

        // Unset the flash message cookie
        setcookie('login_message', '', time() - 3600, "/");
    }

    if ($user->role == "student") {
        include("../templates/login_success_student.php");
    } else if ($user->role == "la") {
        include("../templates/login_success_la.php");
    }

    include("../include/footer.inc.php");
} else {
    header('location:login.php');
}
