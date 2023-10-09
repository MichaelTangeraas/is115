<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 4.1</title>
</head>

<script>
    <?php

    $task_array = array(
        0 => "B",
        3 => "A",
        5 => "N",
        7 => "A",
        8 => "N",
        15 => "A"
    )

    ?>
</script>

<body>

    <h1>Welcome to Module 4.1</h1>
    <p>In this assigment, we use array's to store keys and values. We then print out the content of the array using a foreach loop and the print_r() function.</p>

    <hr />

    <h2>Displaying content of array</h2>
    <p><strong>Using print_r() to print out the contents of the array:</strong> <br />
        <?php
        print_r($task_array);
        ?>
    </p>

    <p><strong>Using a foreach loop to print out the contents of the array:</strong> <br />
        <?php
        foreach ($task_array as $key => $value) {
            echo $key . " => " . $value . "<br />";
        }
        ?>
    </p>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>