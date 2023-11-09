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

// Define a class Student that extends from the User class
class Student extends User
{
    // Declare a public property for the university
    public $university;

    // Constructor function for the Student class
    function __construct($fname, $lname, $username, $date_of_birth, $registered, $university)
    {
        // Call the parent class's constructor
        parent::__construct($fname, $lname, $username, $date_of_birth, $registered);
        // Set the university property
        $this->university = $university;
    }

    // Function to return a greeting message
    function greeting()
    {
        // Return a greeting message with the student's full name and university
        return "Hello, my name is " . $this->fname . " " . $this->lname . " and I attend " . $this->university . ".";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 6.2</title>
</head>

<h1>Module 6.2</h1>

<p>In module 6.2, we are following up on the work that was conducted in module 6.1.
    <br />
    This time around we are using inheritance to create a new class called "student" that inherits from the User class.
</p>

<hr />

<h2>User Class</h2>
<?php
// Create a new instance of the User class
$newUser = new User("John", "Doe", "jellyfish20", "01/01/2000", "01/01/2020");
// Output the greeting message of the new user
echo "<p>" . $newUser->greeting() . "</p>";
?>

<hr />

<h2>Student Class</h2>
<?php
// Create a new instance of the Student class
$newStudent = new Student("Jimmy", "Johnson", "salmonhunter17", "01/01/1995", "01/01/2021", "University of Agder");
// Output the greeting message of the new student
echo "<p>" . $newStudent->greeting() . "</p>";
?>

<hr />

<p><a href="../">Click here to go back to Module 6 dashboard</a></p>

</body>

</html>