<?php

session_start();

    $title = 'Log In';
    $error = 'Not log in';
    require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);


if (isset($_POST['submit'])){
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $values = [
        'email' => $_POST['email']
        ];
        $stmt->execute($values);

    $row = $stmt->fetch();
    $hash = $row['password'];
    $check = password_verify($_POST['password'], $hash);

        if ($check) {
            $_SESSION['logged in as user'] = true;
            $_SESSION['email'] = $_POST['email'];
            echo 'You are now logged in  ' . ' Logout here: <a href="logout.php"> Logout</a>';
        }


else { 
?>

<form action="login.php" method="POST">
 <label>Email: </label>
 <input type="email" name="email" />
 <label>Password: </label>
 <input type="password" name="password" />
 <label> <?php echo $error; ?> </label>
 <input type="submit" name="submit" value="Log In" />
</form>
<?php
    }
}

else {
    ?>
<form action="login.php" method="POST">
 <label>Username: </label>
 <input type="email" name="email" />
 <label>Password: </label>
 <input type="password" name="password" />
 <input type="submit" name="submit" value="Log In" />
</form>

<?php

}
require 'footer.php';
?>