<?php

session_start();

$title = 'Review';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

$stmt = $pdo->prepare('SELECT * FROM users');

$stmt->execute();

while ($users = $stmt->fetch()) {

	if ($users['email'] == $_SESSION['email']) {
		$id = $users['id'];
	}
}


if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO review(review_customer, userId, auctionId)
						   VALUES (:review_customer, :userId, :auctionId)');


	$values = [
        'review_customer' => $_POST['review_customer'],
				'userId' => $id,
				'auctionId' => $_SESSION['auctionId']
	];
	
	$stmt->execute($values);

	echo 'Review added';

}

?>	



<?php
require 'footer.php';
?>