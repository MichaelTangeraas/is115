<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3.3</title>
</head>

<script>
    <?php

    $balance = 0;
    $interest = 0;
    $years = 0;
    $sum = 0;

    ?>
</script>

<body>

    <h1>Welcome to Module 3.3</h1>

    <p>In this assignment we are creating a balance and interests calculator for finding the value after X years.</p>

    <hr />

    <form action="" method="post">
        <label for="balance">Balance:</label>
        <input type="number" name="balance" id="balance" placeholder="Enter Balance" required>
        <br>
        <label for="interest">Interest (in %):</label>
        <input type="number" name="interest" id="interest" placeholder="Enter Interest" required>
        <br>
        <label for="years">Years:</label>
        <input type="number" name="years" id="years" placeholder="Enter Years" required>
        <br>
        <input type="submit" value="Calculate">

    </form>

    <button onclick="window.location.href = 'module3_3.php';">Reset</button>

    <?php
    if (isset($_REQUEST['balance']) && isset($_REQUEST['interest']) && isset($_REQUEST['years'])) {
        $balance = $_REQUEST['balance'];
        $interest = $_REQUEST['interest'];
        $years = $_REQUEST['years'];

        echo "<br><br>Balance: $balance<br>";
        echo "Interest: $interest<br>";
        echo "Years: $years<br><br>";

        for ($i = 0; $i <= $years; $i++) {
            $sum = $balance * (1 + $interest / 100) ** $i;
            echo "Year $i: $sum<br>";
        }
    }

    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 3 dashboard</a></p>

</body>

</html>