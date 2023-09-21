<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3.1</title>
</head>

<script>
    <?php

    $application_deadline = strtotime('2023-09-20 23:59:59');
    $current_time = time();

    ?>
</script>

<body>

    <h1>Welcome to Module 3.1</h1>
    <p>In this assignement we are using control structures to check if a job application deadline is overdue.</p>

    <hr />

    <h2>Job listing</h2>
    <p>We are looking for new employees at our company. Final deadline for applications is: <?php echo date('d.m.y H:i:s', $application_deadline) ?></p>

    <hr />

    <h2>Is deadline overdue?</h2>

    <?php
    echo "Current time: " . date('d.m.y H:i:s', $current_time) . "<br />";

    if ($current_time > $application_deadline) {
        echo "The deadline (" . date('d.m.y H:i:s', $application_deadline) . ") has passed.";
    } else {
        echo "The deadline (" . date('d.m.y H:i:s', $application_deadline) . ") is still valid.";
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 3 dashboard</a></p>

</body>

</html>