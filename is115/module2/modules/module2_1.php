<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 2.1</title>
</head>

<script>
    <?php
    $l_name = "tANGerAAS";
    ?>
</script>

<body>

    <h1>Welcome to Module 2.1</h1>

    <p>Below you will find the PHP variable l_name defined before and after string formating. We also print out the length of the string value.</p>

    <hr />

    <h2>Before formating</h2>
    <p>This is the last name variable before reformating: <?php echo $l_name ?></p>

    <hr />

    <?php $l_name = ucfirst(strtolower($l_name)); ?>

    <h2>After formating</h2>
    <p>This is the last name variable after reformating: <?php echo $l_name ?></p>
    <p>The length of the string is: <?php echo strlen($l_name) ?></p>

    <hr />

    <p><a href="../">Click here to go back to Module 2 dashboard</a></p>

</body>

</html>