<?php

// Function for testing input data
function inputCleaner($data)
{
    $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); // Remove backslashes (\)
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Convert special characters to HTML entities
    return $data;
}

// define variables and set to empty values
$nameErr = $p_numberErr = $emailErr = $genderErr = "";
$name = $p_number = $email = $gender = "";

// Array for storing data
$stored_data = array();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is115_module";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = inputCleaner($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[\p{L}\s-]+$/u", $name)) {
            $nameErr = "Only letters and white space allowed. Try something like 'Ola Nordmann'";
        } else {
            $stored_data["stored_name"] = $name;
        }
    }
    if (empty($_POST["p_number"])) {
        $p_numberErr = "Phone Number is required";
        echo $p_numberErr;
    } else {
        $p_number = inputCleaner($_POST["p_number"]);
        // Check if the input is a valid Norwegian mobile number with exactly 8 digits
        if (!preg_match("/^[0-9]{8}$/", $p_number)) {
            echo "The input <strong>$p_number</strong> is not a valid mobile number. Please enter exactly 8 digits.<br>";
        } else {
            $stored_data["stored_p_number"] = $p_number;
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = inputCleaner($_POST["email"]);
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
        $stored_data["stored_gender"] = inputCleaner($_POST["gender"]);
    }

    // Insert data into the database if there are no validation errors
    if (empty($nameErr) && empty($p_numberErr) && empty($emailErr) && empty($genderErr)) {
        $sql = "INSERT INTO users (name, phone_number, email, gender) VALUES ('$name', '$p_number', '$email', '$stored_data[stored_gender]')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 7.2</title>
</head>

<body>

    <h1>Module 7.2</h1>

    <p>In module 7.2,</p>

    <hr />

    <h2>Form registration of a user</h2>

    <h4>Fill out the form below to register</h4>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        Name: <input type="text" name="name" value="<?php echo $name ?>">
        <span class="error" style="color: red;">* <?php echo $nameErr; ?></span>

        <br><br>

        Phone number:
        <input type="number" name="p_number" value="<?php echo $p_number ?>">
        <span class="error" style="color: red;">* <?php echo $p_numberErr; ?></span>

        <br><br>

        E-mail:
        <input type="text" name="email" value="<?php echo $email ?>">
        <span class="error" style="color: red;">* <?php echo $emailErr; ?></span>

        <br><br>

        Gender:
        <?php
        $genders = ['female', 'male', 'other'];
        foreach ($genders as $option) {
            echo '<input type="radio" name="gender" value="' . $option . '"';
            if (isset($stored_data["stored_gender"]) && $stored_data["stored_gender"] == $option) {
                echo ' checked';
            }
            echo '>' . ucfirst($option) . ' ';
        }
        ?>
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
        // Display all registered users in HTML table
        $result = $conn->query("SELECT * FROM '7.2'");

        if ($result->num_rows > 0) {
            echo "<h2>All Registered Users:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Name</th><th>Phone Number</th><th>Email</th><th>Gender</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['phone_number']}</td><td>{$row['email']}</td><td>{$row['gender']}</td></tr>";
            }

            echo "</table>";
        } else {
            echo "<h2>No Registered Users</h2>";
        }
    }
    ?>