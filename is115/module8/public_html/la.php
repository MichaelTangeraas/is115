<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['userID']) && isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] == "la") {

    include_once('../include/db.inc.php');
    include_once('../classes/database.php');

    // Include the header, content, and footer files
    include("../include/header.inc.php");
    // Check if the flash message cookie is set
    if (isset($_COOKIE['login_message'])) {
        // Display the flash message
        echo "<b>" . $_COOKIE['login_message'] . "</b><br>";

        // Unset the flash message cookie
        setcookie('login_message', '', time() - 3600, "/");
    }
    include("../templates/login_success_la.php");
    include("../include/footer.inc.php");
} else if ($_SESSION['role'] == "student") {
    header('location:student.php');
} else {
    header('location:login.php');
}
