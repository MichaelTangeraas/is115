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
    if ($user->role == "student") {
        include("../templates/login_success_student.php");
    } else if ($user->role == "la") {
        include("../templates/login_success_la.php");
    } else {
        include("../templates/login_success.php");
    }
    include("../include/footer.inc.php");
} else {
    header('location:login.php');
}
