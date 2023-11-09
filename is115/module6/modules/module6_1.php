<?php

class User
{
    // User's first name
    public $fname;

    // User's last name
    public $lname;

    // User's username
    public $username;

    // User's date of birth
    public $date_of_birth;

    // Date when the user registered
    public $registered;

    // Constructor function to initialize the User object
    function __construct($fname, $lname, $username, $date_of_birth, $registered)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->username = $username;
        $this->date_of_birth = $date_of_birth;
        $this->registered = $registered;
    }

    // Function to return a greeting message
    function greeting()
    {
        return "Hello, my name is " . $this->fname . " " . $this->lname . " and my username is " . $this->username . ".";
    }

    // Function to update the user's full name
    function updateFullName($fname, $lname)
    {
        $this->fname = $fname;
        $this->lname = $lname;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 6.1</title>
</head>

<h1>Module 6.1</h1>

<p>In module 6.1 we are creating Object-oriented programming (OOP) classes in PHP.
    <br />
    For this module, we are creating a class called User and adding two methods/functions to it.
</p>

<hr />

<h2>Creating a User object and testing functions</h2>

<?php

/**
 * Create a new User object with the given parameters and call the greeting method to display a greeting message.
 * Then update the full name of the user and call the greeting method again to display the updated greeting message.
 */

$newUser = new User("John", "Doe", "jellyfish20", "01/01/2000", "01/01/2020");
echo "<p>" . $newUser->greeting() . "</p>";
$newUser->updateFullName("Max", "Weston");
echo "<p>" . $newUser->greeting() . "</p>";

?>

<hr />

<p><a href="../">Click here to go back to Module 6 dashboard</a></p>

</body>

</html>