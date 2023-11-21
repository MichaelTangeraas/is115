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
    <title>Module 7.4</title>
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

<h1>Module 7.4</h1>

<p>In module 7.4, we are updating the db for module 7.1 by only displaying the current and upcoming appointments.</p>

<hr />

<h2>Table output of data:</h2>

<?php
try {
    $currentDate = date('d-m-Y');

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
    $sql->execute();

    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        // Separate the appointments into overdue and upcoming
        $overdueAppointments = [];
        $upcomingAppointments = [];

        foreach ($result as $row) {
            $bookingDate = DateTime::createFromFormat('d-m-Y', $row['booking_date'])->format('d-m-Y');

            if ($bookingDate < $currentDate) {
                $overdueAppointments[] = $row;
            } else {
                $upcomingAppointments[] = $row;
            }
        }

        // // Display overdue appointments which could be used if needed.
        // echo '<h2>Overdue Appointments</h2>';
        // if (count($overdueAppointments) > 0) {
        //     echo '<table>';
        //     echo '<tr>';
        //     foreach ($overdueAppointments[0] as $key => $value) {
        //         echo '<th>' . ucfirst($key) . '</th>';
        //     }
        //     echo '</tr>';

        //     foreach ($overdueAppointments as $row) {
        //         echo '<tr>';
        //         foreach ($row as $value) {
        //             echo '<td>' . $value . '</td>';
        //         }
        //         echo '</tr>';
        //     }

        //     echo '</table>';
        // } else {
        //     echo 'No overdue records found';
        // }

        // Display upcoming appointments table
        echo '<h2>Current & Upcoming Appointments</h2>';
        // Check if there are any upcoming appointments
        if (count($upcomingAppointments) > 0) {
            // Start table
            echo '<table>';
            // Start table row
            echo '<tr>';
            // Loop through the first appointment to get the table headers
            foreach ($upcomingAppointments[0] as $key => $value) {
                // Output table header
                echo '<th>' . ucfirst($key) . '</th>';
            }
            // End table row
            echo '</tr>';

            // Loop through each appointment
            foreach ($upcomingAppointments as $row) {
                // Start table row
                echo '<tr>';
                // Loop through each value in the appointment
                foreach ($row as $value) {
                    // Output table data
                    echo '<td>' . $value . '</td>';
                }
                // End table row
                echo '</tr>';
            }

            // End table
            echo '</table>';
        } else {
            // No upcoming appointments found
            echo 'No upcoming records found';
        }
    } else {
        // No records found at all
        echo 'No records found';
    }
} catch (PDOException $e) {
    // Output any PDO exceptions
    echo "Error: " . $e->getMessage();
}

// Close the db connection
$conn = null;
?>

<hr />

<p><a href="../">Click here to go back to Module 7 dashboard</a></p>

</body>

</html>