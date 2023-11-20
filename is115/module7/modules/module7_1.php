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
    echo "Connected successfully";
} catch (PDOException $e) {
    // If connection fails, print the error message. SHOULD NOT BE USED IN PRODUCTION!
    echo "Connection failed: " . $e->getMessage();
}
// // Use this to close the db connection!
// $conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 7.1</title>
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

<h1>Module 7.1</h1>

<p>In module 7.1, we are fetching data from our XAMPP database and displaying it in a table.
    <br />
    The data that we are fetching is from a guidencen booking system.
</p>

<hr />

<h2>Table output of data:</h2>

<?php
try {
    // Prepare a SQL query to select data from the guidance_bookings table
    $sql = $conn->prepare(
        "SELECT 
            id, 
            booking_header, 
            DATE_FORMAT(booking_date, '%d-%m-%Y') AS booking_date, 
            appointee, 
            supervisor, 
            DATE_FORMAT(booking_registered, '%d-%m-%Y') AS booking_registered 
        FROM 
            guidance_bookings"
    );

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
    } else {
        // If no results were found, output a message
        echo 'No records found';
    }
} catch (PDOException $e) {
    // If there was an error with the SQL, output the error message! SHOULD NOT BE USED IN PRODUCTION!
    echo "Error: " . $e->getMessage();
}

// Use this to close the db connection!
$conn = null;
?>

<hr />

<p><a href="../">Click here to go back to Module 7 dashboard</a></p>

</body>

</html>