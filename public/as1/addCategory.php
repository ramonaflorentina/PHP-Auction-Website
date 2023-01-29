<?php

session_start();

$title = 'Add Category';
require 'header.php';

$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


if (isset($_SESSION['logged in as user'])) {
	echo 'You are seeing this because you are logged in';
	$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO category(name)
						   VALUES (:name)');


	$values = [
        'name' => $_POST['name']

	];
	
	$stmt->execute($values);

	echo 'Category added';

}
else {
	?>

	<form action="addCategory.php" method="post">
        <label>Add category</label>
		<input type="text"  name="name"/>

		<input type="submit" value="submit" name="submit" />
	</form>

<?php
}
}
else {
 echo 'Sorry, you must be logged in to view this page.' . 'Login here: <a href="login.php">Login</a>';
}


require 'footer.php';
?>