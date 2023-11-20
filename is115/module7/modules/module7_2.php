<?php
// Database server details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is115_module";

// Try to establish a connection with the database
try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection is successful, print a message
    echo "Connected successfully <br>";
} catch (PDOException $e) {
    // If connection fails, print the error message. SHOULD NOT BE USED IN PRODUCTION!
    echo "Connection failed: " . $e->getMessage();
}

// Function for testing input data
function inputCleaner($data)
{
    $data = trim($data); // Strip unnecessary characters (extra space, tab, newline)
    $data = stripslashes($data); // Remove backslashes (\)
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Convert special characters to HTML entities
    return $data;
}

// define variables and set to empty values
$nameErr = $phoneErr = $emailErr = $roleErr = "";
$name = $phone = $email = $role = "";

// Check if form has been submitted
if (isset($_POST["register"])) {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = inputCleaner($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[\p{L}\s-]+$/u", $name)) {
            $nameErr = "Only letters and white space allowed. Try something like 'Ola Nordmann'";
        } else {
            $stored_name = $name;
        }
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone Number is required";
    } else {
        $phone = inputCleaner($_POST["phone"]);
        // Check if the input is a valid Norwegian mobile number with exactly 8 digits
        if (!preg_match("/^[0-9]{8}$/", $phone)) {
            $phoneErr = "The input <strong>$phone</strong> is not a valid mobile number. Please enter exactly 8 digits.";
        } else {
            $stored_phone = $phone;
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
            $stored_email = $email;
        }
    }
    if (empty($_POST["role"])) {
        $roleErr = "role is required";
    } else if ($_POST["role"] != "student" && $_POST["role"] != "la") {
        $roleErr = "Invalid role. Please select either 'student' or 'la'";
    } else {
        $stored_role = inputCleaner($_POST["role"]);
    }

    // Insert data into the database if there are no validation errors
    if (isset($stored_name) && isset($stored_phone) && isset($stored_email) && isset($stored_role)) {
        // Prepare a SQL query for insertion
        $sql = $conn->prepare("INSERT INTO guidance_users (name, phone, email, role) VALUES (:name, :phone, :email, :role)");

        // Bind parameters
        $sql->bindParam(':name', $stored_name);
        $sql->bindParam(':phone', $stored_phone);
        $sql->bindParam(':email', $stored_email);
        $sql->bindParam(':role', $stored_role);

        // Execute the prepared statement
        if ($sql->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql->errorInfo()[2];
        }
    }
}

// Process form submission when the button is clicked
if (isset($_POST['truncate'])) {
    // Prepare and execute the SQL script to truncate the table
    try {
        $sql = "TRUNCATE TABLE guidance_users";
        $conn->exec($sql);

        echo "Table has been truncated.";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 7.2</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Module 7.2</h1>

    <p>In module 7.2, we are building upon a previous task (Modual 4.2) where we created a form for submission
        <br />
        This time around, we are sending the data to our database!
    </p>

    <hr />

    <h2>Form registration of a user to DB</h2>

    <h4>Fill out the form below to register</h4>

    <form method="post" action="">

        Name: <input type="text" name="name" placeholder="John Doe">
        <span class="error" style="color: red;">* <?php echo $nameErr; ?></span>

        <br><br>

        Phone number:
        <input type="number" name="phone" placeholder="(+47)">
        <span class="error" style="color: red;">* <?php echo $phoneErr; ?></span>

        <br><br>

        E-mail:
        <input type="text" name="email" placeholder="john@doe.com">
        <span class="error" style="color: red;">* <?php echo $emailErr; ?></span>

        <br><br>

        role:

        <input type="radio" name="role" value="student">Student
        <input type="radio" name="role" value="la">LA
        <span class="error" style="color: red;">* <?php echo $roleErr; ?></span>

        <br><br>

        <input type="submit" name="register" value="Register">
        <input type="reset" value="Reset">

    </form>

    <?php
    // Prepare a SQL query to select data from the guidance_users table
    $sql = $conn->prepare("SELECT * FROM guidance_users");

    // Execute the SQL query
    $sql->execute();

    // Fetch all the results as an associative array
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Check if the result has more than 0 rows
    if (count($result) > 0) {
        // Start a table
        echo '<table>';
        echo '<tr>';

        // Create table headers from the keys/column names in the result
        foreach ($result[0] as $key => $value) {
            echo '<th>' . ucfirst($key) . '</th>';
        }
        echo '</tr>';

        // Loop through each result
        foreach ($result as $row) {
            echo '<tr>';

            // Loop through and output each value in the result
            foreach ($row as $key => $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        // End the table
        echo '</table>';
        echo '<form method="post" action="">
        <input type="submit" name="truncate" value="Truncate Table">
        </form>';
    } else {
        // If no results were found, output a message
        echo '<h2>No Registered Users</h2>';
    }

    // Close the connection
    $conn = null;
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 7 dashboard</a></p>

</body>

</html>