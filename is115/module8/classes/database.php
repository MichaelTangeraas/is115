<?php

include_once('../include/db.inc.php');

class Database
{
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Inserts a new user into the database.
     *
     * This function takes a first name, last name, email, and password as input and inserts a new user into the `booking_users` table in the database.
     *
     * @param string $fname The first name of the user.
     * @param string $lname The last name of the user.
     * @param string $email The email address of the user.
     * @param string $password The password of the user.
     *
     * @return void
     */
    function insertToDB($fname, $lname, $email, $password)
    {
        try {
            // Prepare an SQL INSERT statement
            $sql = "INSERT INTO `booking_users` (fname, lname, email, password) VALUES (:fname, :lname, :email, :password)";
            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare the statement
            $query = $this->pdo->prepare($sql);

            // Protect against SQL injections
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);

            // Execute the statement
            $query->execute();
        } catch (PDOException $e) {
            // Print the error message if the insertion fails. In almost all cases this will be due to a duplicate email address.
            echo "En bruker med mailen " . $email . " finnes allerede";
        }
        $this->pdo = null;
    }

    /**
     * Retrieves a user from the database using their email.
     *
     * @param string $email The email of the user to retrieve.
     * @return object|null The user object if found, null otherwise.
     */
    function selectUserFromDBEmail($email)
    {
        // SQL query to get user with the given email
        $sql = "SELECT * FROM `booking_users` WHERE `email`= :email";

        // Prepare the SQL query
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        try {
            // Execute the SQL query
            $query->execute();
        } catch (PDOException $e) {
            // Print an error message if the query fails
            echo "Feil email eller passord";
            exit();
        }

        // Fetch the user data
        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    /**
     * Select a user's information from the database based on UserID.
     *
     * This function takes a user ID as input and fetches the corresponding user's information from the `booking_users` table in the database.
     *
     * @param string $userID The ID of the user to be fetched.
     *
     * @return object Returns an object containing the user's information.
     */
    function selectUserFromDBUserId($userID)
    {
        // Prepare an SQL SELECT statement
        $sql = "SELECT * FROM `booking_users` WHERE userID = :userID";
        // Set the PDO error mode to exception
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Prepare the statement
        $query = $this->pdo->prepare($sql);

        // Protect against SQL injections
        $query->bindParam(':userID', $userID, PDO::PARAM_STR);

        // Execute the statement
        $query->execute();

        // Fetch the result as an object
        $user = $query->fetch(PDO::FETCH_OBJ);

        // Return the result
        return $user;
    }
}
