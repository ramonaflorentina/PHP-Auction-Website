<?php
session_start();

$title = 'Bid form';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';


$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

$stmt = $pdo->prepare('SELECT * FROM users');

$stmt->execute();

while ($users = $stmt->fetch()) {

	if ($users['email'] == $_SESSION['email']) {
		$id = $users['id'];
	}
}


if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO bid(bid, userId, auctionId)
						   VALUES ( :bid, :userId, :auctionId)');


	$values = [ 
		'bid' => $_POST['bid'],
		'userId' => $id,
		'auctionId' => $_SESSION['auctionId']
	];
	
	$stmt->execute($values);

	echo 'Bid Added';

}

 else { 
?>

<form action="bidform.php" method="POST">
     <input type="text" name="bid" placeholder="Enter bid amount" />
     <input type="submit" value="submit" name="submit"/>
</form>


<?php
 }
require 'footer.php'
?>