<?php
session_start();

$title = 'Logout';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);



if (isset($_POST['submit'])) {
    unset($_SESSION['logged in as user']);
    unset($_SESSION['Admin login']);
    unset($_SESSION['email']);
    unset($_SESSION['auctionId']);
    echo 'You are now logged out' . ' Login here: <a href="login.php">Login</a>' ;
}

else {
?>

<form action="logout.php" method="POST">
 <label>Logout: </label>
 <input type="submit" name="submit" value="Log Out" />
</form>


<?php
}
require 'footer.php';
?>