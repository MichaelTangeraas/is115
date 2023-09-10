<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module 1.4</title>
</head>


<!-- Variables used in module 1.4 -->
<script>
    <?php

    $number1 = 10;
    $number2 = 5;
    $result = 0;

    ?>
</script>

<body>
    <h1>Welcome to Module 1.4</h1>

    <p>The aim for this module is to display the act of solving mathematical tasks using integer values stored in a PHP script. The results will be displayed on this html page.</p>

    <hr />

    <h4>The stored values for $number1, $number2 and $result are as follows:</h4>

    <!-- List of variable values -->

    <ul>
        <li>$number1 = <?php echo $number1; ?></li>
        <li>$number2 = <?php echo $number2; ?></li>
        <li>$result = <?php echo $result; ?> (will be updated throughout the calculations)</li>
    </ul>

    <hr />

    <!-- Displaying calculations -->

    <h3>Displaying the calculation in HTML</h3>

    <h4>The results of the calculations are as follows:</h4>

    <!-- Getting the sum of the numbers -->

    <p>The sum of $number1 + $number2 =
        <?php $result = $number1 + $number2;
        echo $result; ?>
    </p>

    <h4>New value of $result: <?php echo $result; ?></h4>

    <!-- Finding the average of the sum -->

    <p>The average of the updated value in $result =
        <?php $result /= 2;
        echo $result; ?>
    </p>

    <h4>Final value for $result: <?php echo $result; ?></h4>

    <hr />

    <!-- Dashboard Navigation -->

    <p><a href="../">Click here to go back to Module 1 dashboard</a></p>

</body>

</html>