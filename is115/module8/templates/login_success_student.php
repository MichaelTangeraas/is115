<?php
include_once('../include/db.inc.php');
include_once('../classes/database.php');
?>

<h3>
    If you see this, you have managed to log in!
</h3>

<?php
$conn = new Database($pdo);
$user = $conn->selectUserFromDBUserId($_SESSION['userID']);

echo "Welcome, " . $user->fname . " " . $user->lname . "! <br>";
echo "Your role is: <b>" . $user->role . "</b><br>";
echo "This is a custome message that is only displayed to students!<br>";
echo "<h2>The red fox jumped over the lazy dog</h2>";

?>