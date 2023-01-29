<?php
session_start();

$title = 'Edit Catagories';
require 'header.php';



$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

if (isset($_SESSION['logged in as user'])) {
	echo 'You are seeing this because you are logged in';
	$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


if (isset($_POST['submit'])) {
	
	$stmt = $pdo->prepare('UPDATE category
						   SET name = :name
						   WHERE id = :id');

	$values = [
		'name' => $_POST['name'],
		'id' => $_POST['id']
	];

$stmt->execute($values); 


echo 'Category "' . $_POST['name'] .  '" updated to "' . $_POST['name'] . '".';


} 
else {

$stmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');

$values = [
 'id' => $_GET['id']
];

$stmt->execute($values); 

$categoryId = $stmt->fetch(); 


?>
<form action="editCategory.php" method="POST">
<label>Category name</label>
<input type="text" name="name" value="<?php echo $categoryId['name']; ?>" />
<label>Category ID</label>
<input type="text" name="id" value="<?php echo $categoryId['id']; ?>" />
<input type="submit" name="submit" value=”Submit” />
</form>

<?php
}
}

else {
	echo 'Sorry, you must be logged in to view this page.' . 'Login here: <a href="login.php">Login</a>';
 }

require 'footer.php';
?>