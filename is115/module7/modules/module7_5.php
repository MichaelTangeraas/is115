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
$nameErr = $phoneErr = $emailErr = $la1Err = $la2Err = "";
$name = $phone = $email = $la1 = $la2 = "";

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
    if (empty($_POST["teacher_assistant1"])) {
        // check if teacher assistant 1 is selected
        $la1Err = "Teacher Assistant 1 is required";
    } else {
        $la1 = inputCleaner($_POST["teacher_assistant1"]);
        $stored_la1 = $la1;
    }
    if (empty($_POST["teacher_assistant2"])) {
        // check if teacher assistant 2 is selected
        $la2Err = "Teacher Assistant 2 is required";
    } else {
        $la2 = inputCleaner($_POST["teacher_assistant2"]);
        $stored_la2 = $la2;
    }

    // Insert data into the database if there are no validation errors
    if (isset($stored_name) && isset($stored_phone) && isset($stored_email) && isset($stored_la1) && isset($stored_la2)) {
        // Prepare a SQL query for insertion
        $sql = $conn->prepare("INSERT INTO users (name, phone, email, pref_la1, pref_la2) VALUES (:name, :phone, :email, :pref_la1, :pref_la2)");

        // Bind parameters
        $sql->bindParam(':name', $stored_name);
        $sql->bindParam(':phone', $stored_phone);
        $sql->bindParam(':email', $stored_email);
        $sql->bindParam(':pref_la1', $stored_la1);
        $sql->bindParam(':pref_la2', $stored_la2);

        // Execute the prepared statement
        if ($sql->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql->errorInfo()[2];
        }
    }
}

// For the truncate button - Process form submission when the button is clicked
// Truncate will empty the table and reset the auto increment
if (isset($_POST['truncate'])) {
    // Prepare and execute the SQL script to truncate the table
    try {
        $sql = "TRUNCATE TABLE users";
        $conn->exec($sql);

        echo "Table has been truncated.";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage()); // MESSAGE SHOULD NOT BE USED IN PRODUCTION!
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 7.5</title>
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

    <h1>Module 7.5</h1>

    <p>In module 7.5, we are taking on a bit more of an advanded challenge. Based on the user registration of module 7.2, we are now letting the user decided upon two preferances for teacher assistanents (LA) when signing up.
        <br />
        The preferances are stored in the database and displayed in a table below. To achieve better normalization in our database, we are storing the LA's in a seperate table and referencing them in the users table.
        <br />
        To fetch out the data from the database, we are using a JOIN statement to combine the two tables. We are also using the GROUP_CONCAT function to combine the names of the users into a single string.
        <br />
        Finally, we are using the GROUP BY statement to group the results by the preferances.
    </p>

    <hr />

    <h2>Form registration of a user to DB</h2>

    <h4>Fill out the form below to register</h4>

    <form method="post" action="">

        <!-- Form for name input -->
        Name: <input type="text" name="name" placeholder="John Doe">
        <span class="error" style="color: red;">* <?php echo $nameErr; ?></span>

        <br><br>

        <!-- Form for phone input -->
        Phone number:
        <input type="number" name="phone" placeholder="(+47)">
        <span class="error" style="color: red;">* <?php echo $phoneErr; ?></span>

        <br><br>


        <!-- Form for email input -->
        E-mail:
        <input type="text" name="email" placeholder="john@doe.com">
        <span class="error" style="color: red;">* <?php echo $emailErr; ?></span>

        <br><br>

        <!-- Form for teacher assistant preferance #1 input -->
        <label for="teacher_assistant1">Preferred Teacher Assistant 1:</label>
        <select name="teacher_assistant1" id="teacher_assistant1">
            <option value="" disabled selected>Select your option</option>
            <!-- Options for the first teacher assistant -->
            <?php
            // Fetch teacher assistant options from the database
            $sql = $conn->prepare("SELECT laID, name FROM la");
            $sql->execute();
            $teacherAssistants = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Display options in the dropdown menu
            foreach ($teacherAssistants as $assistant) {
                echo '<option value="' . $assistant['laID'] . '">' . $assistant['name'] . '</option>';
            }
            ?>
        </select>
        <span class="error" style="color: red;">* <?php echo $la1Err; ?></span>

        <br><br>

        <!-- Form for teacher assistant preferance #2 input -->
        <label for="teacher_assistant2">Preferred Teacher Assistant 2:</label>
        <select name="teacher_assistant2" id="teacher_assistant2">
            <option value="" disabled selected>Select your option</option>
            <!-- Options for the second teacher assistant -->
            <?php
            // Fetch teacher assistant options from the database
            $sql = $conn->prepare("SELECT laID, name FROM la");
            $sql->execute();
            $teacherAssistants = $sql->fetchAll(PDO::FETCH_ASSOC);

            // Display options in the dropdown menu
            foreach ($teacherAssistants as $assistant) {
                echo '<option value="' . $assistant['laID'] . '">' . $assistant['name'] . '</option>';
            }
            ?>
        </select>
        <span class="error" style="color: red;">* <?php echo $la2Err; ?></span>

        <br><br>

        <input type="submit" name="register" value="Register">
        <input type="reset" value="Reset">

    </form>

    <?php
    // Prepare a SQL query to select data from the users table and group by pref_la1
    $sql = $conn->prepare("SELECT pref_la1, la.name as assistant_name, GROUP_CONCAT(users.name SEPARATOR ', ') as user_names FROM users 
                       LEFT JOIN la ON users.pref_la1 = la.laID 
                       GROUP BY pref_la1");

    // Execute the SQL query
    $sql->execute();

    // Fetch all the results as an associative array
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Check if the result has more than 0 rows
    if (count($result) > 0) {
        // Start a table
        echo '<h2>Preferred Teacher Assistant #1</h>';
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
    } else {
        // If no results were found, output a message
        echo '<h2>No Users Registered</h2>';
    }



    // Prepare a SQL query to select data from the guidance_users table and group by pref_la2
    $sql = $conn->prepare("SELECT pref_la2, la.name as assistant_name, GROUP_CONCAT(users.name SEPARATOR ', ') as user_names FROM users 
    LEFT JOIN la ON users.pref_la2 = la.laID 
    GROUP BY pref_la2");

    // Execute the SQL query
    $sql->execute();

    // Fetch all the results as an associative array
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Check if the result has more than 0 rows
    if (count($result) > 0) {
        // Start a table
        echo '<h2>Preferred Teacher Assistant #2</h2>';
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
        <input type="submit" name="truncate" value="Truncate Tables">
        </form>';
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 7 dashboard</a></p>

</body>

</html>