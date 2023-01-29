<?php

$title = 'register';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';
$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);


if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO users(password, email, name )
						   VALUES (:password, :email, :name)');

$password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$values = [
		'password' => $password_hashed,
		'email' => $_POST['email'],
		'name' => $_POST['name']
	];
	
	$stmt->execute($values);

	echo 'Record Added';

	echo '<p><a href="index.php">Back to list</a>';
}
else {
  ?>
	<form action="register.php" method="post">
		<label>Email address</label>
		<input type="text"  name="email" />
		<label>Password</label>
		<input type="text"  name="password" />
		<label>Name</label>
		<input type="text"  name="name" />
		
		<input type="submit" value="submit" name="submit" />
	</form>
	<?php
}

require 'footer.php';
?>