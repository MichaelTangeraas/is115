<?php

// Define a class InputValidator
class InputValidator
{
    // Function to validate an email address
    function emailValidation($email)
    {
        // Use the filter_var function to validate the email address
        // If the email is valid, return true
        // If the email is invalid, return false
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 6.4</title>
</head>

<body>
    <h1>Module 6.4</h1>
    <p>In module 6.4, we are creating an input validation class with a function for validating emails.</p>

    <hr />
    <h2>Email Validation</h2>

    <?php
    // Define email addresses for testing
    $emails = ["valid@email.com", "invalidemail.com"];

    // Create an instance of the InputValidator class
    $validator = new InputValidator();

    // Loop through each email address
    foreach ($emails as $email) {
        // Validate the email address
        // If the email is valid, display a success message
        // If the email is invalid, display an error message
        if ($validator->emailValidation($email)) {
            echo "<p>The email address <strong>$email</strong> is valid.</p>";
        } else {
            echo "<p>The email address <strong>$email</strong> is invalid.</p>";
        }
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 6 dashboard</a></p>

</body>

</html>