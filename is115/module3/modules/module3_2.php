<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3.2</title>
</head>

<script>
    <?php

    $sum = 0;

    ?>
</script>

<body>

    <h1>Welcome to Module 3.2</h1>

    <p>In this assignment we are counting from 0 to 9 by using a for-loop. Each count will have a 1 second delay before the next.</p>

    <hr />

    <?php
    ob_implicit_flush(true);

    echo "Counting from 0 to 9:<br>";

    $sum = 0;

    for ($i = 0; $i <= 9; $i++) {
        echo "$i<br>";
        $sum += $i;
        ob_flush();
        sleep(1);
    }

    echo "<br> Drum roll...<br>";

    ob_flush();
    sleep(2);

    echo "The count is complete! The sum of the count is: $sum";
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 3 dashboard</a></p>

</body>

</html>