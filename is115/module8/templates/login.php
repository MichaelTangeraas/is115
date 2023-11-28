<?php
include("../classes/database.php");
require_once('../include/db.inc.php');


?>

<div class="center">
    <h1>Login</h1>
    <p>Log in to your account</p>
    <form action="login.php" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login" name="login">
    </form>
    <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>

    <?php
    // Check if login form is submitted
    if (isset($_POST['login'])) {

        // Check if email or password field is not empty
        if ($_POST['email'] != "" || $_POST['password'] != "") {

            // Get email from form
            $email = $_POST['email'];

            // Get password from form
            $password = $_POST['password'];

            $pdo = new Database($pdo);

            $user = $pdo->selectUserFromDBEmail($email);

            // Check if user exists
            if ($user != null) {

                // Verify the password
                if (password_verify($password, $user->password)) {

                    // Correct password
                    echo "Correct login credentials<br>";

                    // // Start a new session
                    // session_start();

                    // Store user ID in session
                    $_SESSION['userID'] = $user->userID;

                    // Redirect to index.php which contains content based on role
                    header('location: index.php');

                    // Alternative way to redirect with two specific protected pages.
                    // $_SESSION['role'] = $user->role;
                    // header('location: login_router.php');
                } else {

                    // Incorrect password
                    echo "Wrong username or password<br>";
                }
            } else {

                // Incorrect username or password
                echo "Wrong username or password<br>";

                // Redirect to login.php
                // header('location: login.php');
            }
        } else {
            // Required field is empty
            echo "Please fill in all the fields!<br>";
            // Redirect to login.php
            // header('location: login.php');
        }
    }

    ?>
</div>