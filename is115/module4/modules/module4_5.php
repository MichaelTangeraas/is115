<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 4.5</title>
</head>

<script>
    <?php

    ?>
</script>

<body>

    <h1>Welcome to Module 4.5</h1>
    <p>In this assigment, in this assignment we are using a form to send an "email" locally. We are not actually sending the contact form email, but rather displaying the content on the page after submitting it.</p>
    <p>In almost all cases one would also add validation for each form field, but this was not a requirement in the assignment criteria for module 4.5.</p>

    <hr />

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        echo "<h2>Message Sent</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Subject:</strong> $subject</p>";
        echo "<p><strong>Message:</strong><br>$message</p>";
    } else {
        echo '
    <h1>Contact Us</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>
        
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
    ';
    }
    ?>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>