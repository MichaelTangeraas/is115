<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['userID']) && isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] == "student") {

    include_once('../include/db.inc.php');
    include_once('../classes/database.php');

    // Include the header, content, and footer files
    include("../include/header.inc.php");
    include("../templates/login_success_student.php");
    include("../include/footer.inc.php");
} else if ($_SESSION['role'] == "la") {
    header('location:la.php');
} else {
    header('location:login.php');
}
