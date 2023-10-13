<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 4.2</title>
</head>

<script>
    <?php

    // Function for testing input data
    function test_input($data)
    {
        $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
        $data = stripslashes($data); // Remove backslashes (\)
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }

    // define variables and set to empty values
    $nameErr = $p_numberErr = $emailErr = $genderErr = "";
    $name = $p_number = $email = $gender = "";

    // Array for storing data
    $stored_data = array();

    // Check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' æøåÆØÅéÉ]*$/u", $name)) {
                $nameErr = "Only letters and white space allowed. Try something like 'Ola Nordmann'";
            } else {
                $stored_data["stored_name"] = $name;
            }
        }
        if (empty($_POST["p_number"])) {
            $p_numberErr = "Phone Number is required";
            echo $p_numberErr;
        } else {
            $p_number = test_input($_POST["p_number"]);
            // check if phone number contains only numbers
            if (!preg_match("/^[0-9]*$/", $p_number)) {
                $p_numberErr = "Only numbers allowed. Try something like '12345678'";
            } else {
                $stored_data["stored_p_number"] = $p_number;
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format. Try something like 'ola@nordmann.no'";
            } else {
                $stored_data["stored_email"] = $email;
            }
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $stored_data["stored_gender"] = test_input($_POST["gender"]);
        }
    }

    ?>
</script>

<body>

    <h1>Welcome to Module 4.2</h1>
    <p>In this assignment, we use a form to "register" a user and store the values in an Array. We have also validation for checking for missing or invalide inputs to each form field.</p>

    <hr />

    <h2>Form registration of a user</h2>

    <h4>Fill out the form below to register</h4>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Name: <input type="text" name="name" value="<?php echo $name ?>">
        <span class="error" style="color: red;">* <?php echo $nameErr; ?></span>

        <br><br>

        Phone number:
        <input type="text" name="p_number" value="<?php echo $p_number ?>">
        <span class="error" style="color: red;">* <?php echo $p_numberErr; ?></span>

        <br><br>

        E-mail:
        <input type="text" name="email" value="<?php echo $email ?>">
        <span class="error" style="color: red;">* <?php echo $emailErr; ?></span>

        <br><br>

        Gender:
        <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>>Female
        <input type="radio" name="gender" value="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?>>Male
        <input type="radio" name="gender" value="other" <?php if (isset($gender) && $gender == "other") echo "checked"; ?>>Other
        <span class="error" style="color: red;">* <?php echo $genderErr; ?></span>

        <br><br>

        <input type="submit" name="submit" value="Submit">

    </form>

    <?php
    // Display a message if any error is present
    if (!empty($nameErr) || !empty($p_numberErr) || !empty($emailErr) || !empty($genderErr)) {
        echo "<h2>There were missing or invalid values in the form:</h2>";
        if (!empty($nameErr)) echo "<p>$nameErr</p>";
        if (!empty($p_numberErr)) echo "<p>$p_numberErr</p>";
        if (!empty($emailErr)) echo "<p>$emailErr</p>";
        if (!empty($genderErr)) echo "<p>$genderErr</p>";
    } else {
        if (!empty($stored_data)) {
            echo "<h2>User registered/updated:</h2>";
            if (isset($stored_data["stored_name"])) echo "<p><strong>Name:</strong> " . $stored_data["stored_name"] . "</p>";
            if (isset($stored_data["stored_p_number"])) echo "<p><strong>Phone number:</strong> " . $stored_data["stored_p_number"] . "</p>";
            if (isset($stored_data["stored_email"])) echo "<p><strong>E-mail:</strong> " . $stored_data["stored_email"] . "</p>";
            if (isset($stored_data["stored_gender"])) echo "<p><strong>Gender:</strong> " . $stored_data["stored_gender"] . "</p>";
        } else {
            echo "<h2>No user information registered.</h2>";
        }
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>