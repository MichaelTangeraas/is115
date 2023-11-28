<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
    header('Location: ../public_html/index.php');
} else {
    include('../include/header.inc.php');
    include("../templates/login.php");
    include("../include/footer.inc.php");
}
