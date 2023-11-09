<?php

// Define a class User
class User
{
    // Declare properties for the User class
    public $fname; // User's first name
    public $lname; // User's last name
    protected $username; // User's username
    public $date_of_birth; // User's date of birth
    protected $registered; // Date when the user registered

    // Constructor function to initialize the User object
    function __construct($fname, $lname, $date_of_birth)
    {
        // Initialize properties
        $this->fname = $fname;
        $this->lname = $lname;
        $this->username = $this->generateRandomUsername();
        $this->date_of_birth = $date_of_birth;
        $this->registered = date('d-m-y H:i:s');
    }

    // Function to generate a random username
    protected function generateRandomUsername()
    {
        // Generate a random username based on the user's first name, last name, and a random number
        return strtolower(substr($this->fname, 0, 1) . $this->lname . rand(100, 999));
    }

    // Function to return a greeting message
    function greeting()
    {
        // Return a greeting message with the user's full name and username
        return "Hello, my name is " . $this->fname . " " . $this->lname . " and my username is " . $this->username . ".";
    }

    // Function to update the user's full name
    function updateFullName($fname, $lname)
    {
        // Update the user's first name and last name
        $this->fname = $fname;
        $this->lname = $lname;
    }

    // Destructor to store deleted usernames in an array
    function __destruct()
    {
        // Access the global variable $deletedUsernames
        global $deletedUsernames;

        // Add the user's username to the $deletedUsernames array
        $deletedUsernames[] = $this->username;
    }
}

// Define a class Student that extends from the User class
class Student extends User
{
    // Declare a public property for the university
    public $university;

    // Constructor function for the Student class
    function __construct($fname, $lname, $date_of_birth, $university)
    {
        // Call the parent class's constructor
        parent::__construct($fname, $lname, $date_of_birth);

        // Set the university property
        $this->university = $university;
    }

    // Function to return a greeting message
    function greeting()
    {
        // Return a greeting message with the student's full name, username, and date of registration
        return "Hello, my name is " . $this->fname . " " . $this->lname . ". My username is " . $this->username . ", and I registered on " . $this->registered . ".";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 6.3</title>
</head>

<body>
    <h1>Module 6.3</h1>

    <p>Continuing to build upon the two previous module task, we update our User class to utilize the protected keyword
        <br />to protect the username and registered properties from being accessed outside of the class.
        <br />We updated the $registered variable to automatically store the date and time of registration.
        <br />Lastly we also added a function for generating a random username and a destructor function to store deleted usernames.
    </p>

    <hr />

    <?php

    // Initialize array to store deleted usernames
    $deletedUsernames = [];

    // Create two Student objects
    $student1 = new Student("John", "Doe", "01-01-1980", "University of Agder");
    $student2 = new Student("Jimmy", "Johnson", "02-02-1990", "University of Oslo");

    // Display student information
    echo "<h1>Student Information</h1>";
    echo "<p>" . $student1->greeting() . "</p>";
    echo "<p>" . $student2->greeting() . "</p>";

    echo "<h1>Deleted Student Usernames</h1>";
    // Call the __destruct() method for both Student objects
    $student1->__destruct();
    $student2->__destruct();

    // Display deleted usernames
    echo "<p>Deleted usernames: " . implode(", ", $deletedUsernames) . "</p>";

    ?>
    <hr />

    <p><a href="../">Click here to go back to Module 6 dashboard</a></p>

</body>

</html>