<?php
// Include the database connection file
require_once('../include/db.inc.php');
include_once('../classes/database.php');
// Include the input validator file
require_once('../classes/inputvalidator.php');

// Check if the 'register' button has been clicked
if (isset($_POST['register'])) {

    // Check if the email and password fields are not empty
    if ($_POST['fname'] != "" || $_POST['lname'] != "" || $_POST['email'] != "" || $_POST['password'] != "") {
        $validator = new InputValidator();
        $inputError = false;

        // Get the first name from the form and clean the string
        if ($validator->nameValidator($_POST['fname']) == false) {
            echo "First name is not valid!<br>";
            $inputError = true;
        } else {
            $fname = $validator->cleanName($_POST['fname']);
        }

        // Get the last name from the form and clean the string
        if ($validator->nameValidator($_POST['lname']) == false) {
            echo "Last name is not valid!<br>";
            $inputError = true;
        } else {
            $lname = $validator->cleanName($_POST['lname']);
        }

        // Get the email from the form and clean the string
        if ($validator->emailValidation($_POST['email']) == false) {
            echo "Email is not valid! Use email with valid format.<br>";
            $inputError = true;
        } else {
            $email = $validator->cleanString($_POST['email']);
        }

        // Get the password from the form and clean the string
        if ($validator->passwordValidation($_POST['password']) == false) {
            echo "Password is not valid! Password must contain at least one uppercase letter, two numbers, one special character, and be at least 9 characters long.<br>";
            $inputError = true;
        } else {
            // Hash the password using PHP's built-in password_hash function
            $password = password_hash($validator->cleanString($_POST['password']), PASSWORD_DEFAULT);
        }

        if (isset($fname) && isset($lname) && isset($email) && isset($password) && !$inputError) {
            $insert = new Database($pdo);
            $insert->insertToDB($fname, $lname, $email, $password);
            echo "<br>User successfully created!<br>";
            // Redirect the user to login.php
            // header('location:login.php');
        }
    } else {
        // Print a message if the fields are empty and redirect the user to the registration page
        echo "Please fill in all the fields!<br>";
        header('location:sign_up.php');
    }
}
?>

<!-- HTML form for user registration -->
<div class="center">
    <h1>Sign up</h1>
    <p>Create your account</p>
    <form action="sign_up.php" method="post">
        <label for="fname">First name:</label><br>
        <input type="fname" id="fname" name="fname" required oninvalid="this.setCustomValidity('Please fill in your first name')" oninput="this.setCustomValidity('')"><br>
        <label for="lname">Last Name:</label><br>
        <input type="lname" id="lname" name="lname" required oninvalid="this.setCustomValidity('Please fill in your last name')" oninput="this.setCustomValidity('')"><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required oninvalid="this.setCustomValidity('Please fill in your email')" oninput="this.setCustomValidity('')"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required oninvalid="this.setCustomValidity('Please add a password')" oninput="this.setCustomValidity('')"><br>
        <input type="submit" value="Register" name="register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>