<?php

session_start();

$title = 'Add Auction';
require 'header.php';

$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

if (isset($_SESSION['logged in as user'])) {
 echo 'You are seeing this because you are logged in';
 $pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO auction(title, description, categoryId, endDate)
						   VALUES ( :title, :description, :categoryId, :endDate)');


	$values = [ 
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'categoryId' => $_POST['name'],
		'endDate' => $_POST['endDate']
	];
	
	$stmt->execute($values);

	echo 'Auction Added';

	echo '<p><a href="index.php">Back to list</a>';
}
else {

$stmt = $pdo-> prepare('SELECT * FROM category');
$stmt->execute();
?>

	<form action="addAuction.php" method="post">
		<label>Title</label>
		<input type="text"  name="title" />
        <label>Description</label>
		<input type="text"  name="description" />
		<select name = "name"> 
<?php

foreach ($stmt as $row) {

echo '<option value="' . $row['id'] . '"name="' . $row['id'] . '">' . $row['name'] . '</option>';
}

?>
        <label>Auction end date</label>
		<input type="date"  name="endDate" />
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
