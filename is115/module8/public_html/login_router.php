<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['userID'] && isset($_SESSION['role']) && !empty($_SESSION['role']))) {



    if ($_SESSION['role'] == "student") {
        header('location:student.php');
    } else if ($_SESSION['role'] == "la") {
        header('location:la.php');
    } else {
        header('location:login.php');
    }
} else {
    header('location:login.php');
}
