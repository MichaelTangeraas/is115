<!-- Note to evaluator -->

<!-- Moving forward I will change the structure of my PHP code. I have previously added some of my PHP
    code inside of a <script> tag, but recently I have learned that this is mainly used for embeded client-side javascript.
    I have not reformated previous assignments in this modules due to the fact that I didn't want to break the code in any way.-->

<!-- Another important note about module 4.3 specifically is that I found it very hard to conduct logical checks on the 
    "registered" user, due to the fact that the user is hardcoded on the server side of this page. I think it would be a lot
    easier to conduct this assignment/exercise if the user values were stored on a seperate database in which the values were
    fetched from. Nevertheless this solution was the best I could come up with. -->

<?php
$stored_data = array(
    "stored_name" => "John Doe",
    "stored_p_number" => "123456789",
    "stored_email" => "john.doe@example.com"
);

$nameErr = $p_numberErr = $emailErr = "";
$changesSaved = false;
$noChanges = false;

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' æøåÆØÅéÉ]*$/u", $name)) {
            $nameErr = "Only letters and white space allowed. Try something like 'Ola Nordmann'";
        } else {
            if ($name != $stored_data["stored_name"]) {
                $stored_data["stored_name"] = $name;
                $changesSaved = true;
            } else {
                $noChanges = true;
            }
        }
    }

    if (empty($_POST["p_number"])) {
        $p_numberErr = "Phone Number is required";
    } else {
        $p_number = test_input($_POST["p_number"]);
        if (!preg_match("/^[0-9]*$/", $p_number)) {
            $p_numberErr = "Only numbers allowed. Try something like '12345678'";
        } else {
            if ($p_number != $stored_data["stored_p_number"]) {
                $stored_data["stored_p_number"] = $p_number;
                $changesSaved = true;
            } else {
                $noChanges = true;
            }
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format. Try something like 'ola@nordmann.no'";
        } else {
            if ($email != $stored_data["stored_email"]) {
                $stored_data["stored_email"] = $email;
                $changesSaved = true;
            } else {
                $noChanges = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Module 4.3</title>
</head>

<body>

    <h1>Welcome to Module 4.3</h1>
    <p>In this assignment, we use a form to display an existing user on our page and opens up for updating/editing this user. We have also validation for checking for missing or invalide inputs to each form field.</p>

    <hr />

    <h2>Form registration for updating user</h2>

    <h4>Fill out the form below to update</h4>

    <?php
    if (!empty($nameErr) || !empty($p_numberErr) || !empty($emailErr)) {
        echo "<h2>There were missing or invalid values in the form:</h2>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Name: <input type="text" name="name" value="<?php echo $stored_data["stored_name"]; ?>">
        <span class="error" style="color: red;">* <?php echo $nameErr; ?></span>

        <br><br>

        Phone Number: <input type="text" name="p_number" value="<?php echo $stored_data["stored_p_number"]; ?>">
        <span class="error" style="color: red;">* <?php echo $p_numberErr; ?></span>

        <br><br>

        Email: <input type="text" name="email" value="<?php echo $stored_data["stored_email"]; ?>">
        <span class="error" style="color: red;">* <?php echo $emailErr; ?></span>

        <br><br>

        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>User Profile</h2>

    <?php
    echo "<p><strong>Name:</strong> " . $stored_data["stored_name"] . "</p>";
    echo "<p><strong>Phone number:</strong> " . $stored_data["stored_p_number"] . "</p>";
    echo "<p><strong>E-mail:</strong> " . $stored_data["stored_email"] . "</p>";
    ?>

    <?php if ($changesSaved) : ?>
        <p><strong>Changes have been saved!</strong></p>
    <?php elseif ($noChanges) : ?>
        <p><strong>No changes were made.</strong></p>
    <?php endif; ?>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>