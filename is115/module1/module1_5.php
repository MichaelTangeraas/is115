<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module 1.5</title>
</head>

<script>
    <?php

    $name = "Ivar Michael Tangeraas";
    $greeting = "I hope you have a nice week!";

    ?>
</script>

<body>
    <h1>Welcome to Module 1.5</h1>

    <p>Below you will find a greeting that is displayed with HTML while also using a PHP script and pre-defined variables.</p>

    <hr />

    <!-- Display the greetings -->

    <h3>Displaying the greeting</h3>

    <p>Good morning, <?php echo $name . "! " . $greeting; ?></p>

    <hr />

    <!-- Dashboard Navigation -->

    <p><a href="/is115/module1/">Click here to go back to Module 1 dashboard</a></p>
    <p><a href="/">Click here to go back to Course dashboard</a></p>

</body>

</html>