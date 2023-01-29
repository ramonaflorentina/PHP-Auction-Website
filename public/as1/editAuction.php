<?php
session_start();

$title = 'Edit auction';
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
	
	$stmt = $pdo->prepare('UPDATE auction
						   SET title = :title, description = :description, endDate = :endDate
						   WHERE categoryId = :categoryId');

	$values = [
		'title' => $_POST['title'],
		'description' => $_POST['description'],
		'categoryId' => $_POST['categoryId'],
		'endDate' => $_POST['endDate']
	];

$stmt->execute($values); 

echo 'Auction edited';

} 
else {

$stmt = $pdo->prepare('SELECT * FROM auction WHERE id = :categoryId');

$values = [
 'categoryId' => $_GET['categoryId']
];

$stmt->execute($values); 

$categoryId = $stmt->fetch(); 


?>
<form action="editAuction.php" method="POST">
<label>Auction name</label>
<input type="text" name="title" value="<?php echo $categoryId['title']; ?>" />
<label>Auction description</label>
<input type="text" name="description" value="<?php echo $categoryId['description']; ?>" />
<label>Category ID</label>
<input type="text" name="categoryId" value="<?php echo $categoryId['categoryId']; ?>" />
<label>Auction end date</label>
<input type="text" name="endDate" value="<?php echo $categoryId['endDate']; ?>" />
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