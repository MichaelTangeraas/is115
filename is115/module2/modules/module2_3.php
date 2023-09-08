<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 2.3</title>
</head>

<script>
    <?php
    $valid_email = "ivar@tangeraas.no";
    $invalid_email = "ivar@tangeraas";
    ?>
</script>

<body>

    <h1>Welcome to Module 2.3</h1>

    <p>Below we will use validation to check if an e-mail is formated correctly.</p>

    <hr />

    <h2>Invalide email format</h2>
    <p>Lets try an invalid email: <?php echo $invalid_email ?></p>

    <p><strong>Result: </strong>
        <?php
        if (!filter_var($invalid_email, FILTER_VALIDATE_EMAIL)) {
            echo "This email is invalid, please use try another one with a valid format.";
        } else echo "This email is using valid format.";
        ?>
    </p>

    <hr />

    <h2>Valid email format</h2>
    <p>Lets try an valid email: <?php echo $valid_email ?></p>

    <p><strong>Result: </strong>
        <?php
        if (!filter_var($valid_email, FILTER_VALIDATE_EMAIL)) {
            echo "This email is invalid, please use try another one with a valid format.";
        } else echo "This email is using valid format.";
        ?>
    </p>

    <hr />

    <p><a href="../">Click here to go back to Module 2 dashboard</a></p>

</body>

</html>