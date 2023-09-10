<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Module 1.3</title>
</head>

<script>
    <?php

    $age = 28;
    $name = "Ivar Michael Tangeraas";

    ?>
</script>

<body>

    <h1>Welcome to Module 1.3</h1>

    <p>Below you will find the variables $age and $name defined in PHP, displayed in different HTML elements.</p>

    <hr />

    <!-- Table -->

    <h3>Displaying variables in a Table element</h3>
    <table border="1">
        <tr>
            <th>Variable</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>$age</td>
            <td><?php echo $age; ?></td>
        </tr>
        <tr>
            <td>$name</td>
            <td><?php echo $name; ?></td>
        </tr>
    </table>

    <hr />

    <!-- Numbered List -->

    <h3>Displaying variables in a Numbered List</h3>
    <ol>
        <li>Variable $age is defined as an integer with the value <?php echo $age; ?>.</li>
        <li>Variable $name is defined as a string with the value <?php echo $name; ?>.</li>
    </ol>

    <hr />

    <!-- Unordered List -->

    <h3>Displaying variables in an Unordered List</h3>
    <ul>
        <li>Variable $age is defined as an integer with the value <?php echo $age; ?>.</li>
        <li>Variable $name is defined as a string with the value <?php echo $name; ?>.</li>
    </ul>

    <hr />

    <!-- paragraph -->

    <h3>Displaying variables in "< p>" elements</h3>
    <p>The student that completed this module is,<strong> <?php echo $name; ?> </strong>, and he is <strong> <?php echo $age; ?> </strong> years old.</p>


    <hr />

    <!-- Dashboard Navigation -->

    <p><a href="../">Click here to go back to Module 1 dashboard</a></p>


</body>

</html>