<?php
$title = 'Home';
require 'header.php';
?>

			<article>

				<h2>Home</h2>
				<p> The 10 most recent auctions</p>

				<?php
	
	$server = 'mysql';
	$username = 'student';
	$password = 'student';
	$schema = 'assignment1';


$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);


$stmt = $pdo->prepare('SELECT * FROM auction ORDER BY endDate DESC LIMIT 10');

$stmt->execute();
echo '<ul>';

while ($auction = $stmt->fetch())


{
 echo '<li><a href="viewauction.php?id=' . $auction['id'] . '">' . $auction['title'] .'</a></li>';
}
echo '</ul>';

require 'footer.php'
?>