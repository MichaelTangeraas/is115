<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 4.2</title>
</head>

<script>
    <?php

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

    $stored_data = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z-' æøåÆØÅéÉ]*$/u", $name)) {
                $nameErr = "Only letters and white space allowed. Try something like 'Ola Nordmann'";
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
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format. Try something like 'ola@nordmann.no'";
            }
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
    }

    ?>
</script>

<body>

    <h1>Welcome to Module 4.2</h1>
    <p>Lorem ipsum</p>

    <hr />

    <h2>Form registration of users</h2>

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
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> value="female">Female
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
        <input type="radio" name="gender" <?php if (isset($gender) && $gender == "other") echo "checked"; ?> value="other">Other

        <br><br>

        <input type="submit" name="submit" value="Submit">

    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $p_number;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $gender;
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>