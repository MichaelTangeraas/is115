<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 2.4</title>
</head>

<script>
    <?php
    $number1 = 10;
    $number2 = 5;
    ?>
</script>

<body>

    <h1>Welcome to Module 2.4</h1>

    <p>Below we can demonstrate how we are able to calculate the differentiation between two numbers</p>

    <hr />

    <h2>Variables in use</h2>
    <p>In this assignment we will use two variables.</p>
    <ul>
        <li>$number1 = <?php echo $number1 ?></li>
        <li>$number2 = <?php echo $number2 ?></li>
    </ul>

    <hr />

    <h2>First calculation</h2>
    <p>First, lets find the differentiation between $number1 and $number2</p>
    <p><strong>Result: </strong>
        <?php echo abs($number1 - $number2) ?>
    </p>

    <hr />

    <h2>Second calculation</h2>
    <p>Now, lets flip the math piece and check the difference between $number2 and $number1</p>
    <p><strong>Result: </strong>
        <?php echo abs($number2 - $number1) ?>
    </p>
    <p>One might have expected this result to be -5, but since we want to find the differentiation we want to return a positive value. In our code, we are using abs() to always return the positive difference.</p>

    <hr />

    <p><a href="../">Click here to go back to Module 2 dashboard</a></p>

</body>

</html>