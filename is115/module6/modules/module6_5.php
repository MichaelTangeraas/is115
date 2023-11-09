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

    // Function to validate an input
    function validateInput($input)
    {
        // Check if the input is a valid password
        // A valid password must contain at least one uppercase letter, two digits, one special character, and be at least 9 characters long
        if (preg_match('/^(?=.*[A-Z])(?=.*\d{2,})(?=.*[^a-zA-Z\d]).{9,}$/', $input)) {
            echo "The input <strong>$input</strong> is a valid password.<br>";
        }
        // Check if the input is a valid Norwegian mobile number
        // A valid Norwegian mobile number starts with +47, 0047, 47, or nothing, followed by a digit from 2 to 9, and then 7 more digits
        elseif (preg_match('/^(\+47|0047|47)?[2-9]\d{7}$/', $input)) {
            echo "The input <strong>$input</strong> is a valid Norwegian mobile number.<br>";
        }
        // Check if the input is a valid email address, using the aldready created emailValidation function
        elseif ($this->emailValidation($input)) {
            echo "The input <strong>$input</strong> is a valid email address.<br>";
        }
        // If the input is not a valid password, Norwegian mobile number, or email address, it is invalid
        else {
            echo "The input <strong>$input</strong> is invalid.<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 6.5</title>
</head>

<body>
    <h1>Module 6.5</h1>
    <p>In module 6.5, we are extending the InputValidator class with a function to now validate emails, passwords, and mobile numbers.</p>

    <hr />
    <h2>Input Validation</h2>

    <?php
    // Define inputs for testing
    $inputs = ["ValidP@ssword123", "+4798765432", "invalidemail.com"];

    // Optional inputs for testing
    // $inputs = ["InvaliDPassword3", "+4698765432", "valid@email.com"];

    // Create an instance of the InputValidator class
    $validator = new InputValidator();

    // Loop through each input
    foreach ($inputs as $input) {
        // Validate the input
        $validator->validateInput($input);
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 6 dashboard</a></p>

</body>

</html>