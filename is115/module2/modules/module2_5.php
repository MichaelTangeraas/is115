<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 2.5</title>
</head>

<script>

</script>

<body>

    <h1>Welcome to Module 2.5</h1>

    <p>Below </p>

    <hr />

    <h2>Variables in use</h2>
    <p>
        <?php
        function generatePassword()
        {
            # Define a string of all possible characters, and shuffle it.
            $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shfl = str_shuffle($comb);
            $pwd = substr($shfl, 0, 8);

            # Check if the password contains at least one uppercase letter and one number. If not, generate a new password.
            if (!preg_match('/[A-Z]/', $pwd) || !preg_match('/[0-9]/', $pwd)) {
                return generatePassword();
            }

            return $pwd;
        }

        # recursively call the function until the password is valid.
        echo generatePassword();
        ?>

    </p>

    <button onclick="location.reload()">Refresh</button>

    <hr />

    <p><a href="../">Click here to go back to Module 2 dashboard</a></p>

</body>

</html>