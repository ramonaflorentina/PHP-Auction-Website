<?php
session_start();
$title = 'View Auction';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

// $pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


$auctionStmt = $pdo->prepare('SELECT * FROM auction WHERE id = :id');
$categoryStmt = $pdo->prepare('SELECT * FROM category');
    
$values = [
     'id' => $_GET['id']
];

$auctionStmt->execute($values);
$categoryStmt->execute();

$_SESSION['auctionId'] = $_GET['id'];


while ($auction = $auctionStmt->fetch()) {
?>


<article class="product">

<img src="product.png"/>


<section class="details">


<h2> <?php echo $auction['title']; ?> </h2>
<h3> <?php echo $auction['categoryId']; ?> </h3>
<p>Auction created by <a href="#">User.Name</a></p>
<p class="price">Current bid: £123.45</p>
<time>Time left: 8 hours 3 minutes</time>
</section>


<section class="details"></section>
<form action="bidform.php" method="POST"  class="bid">
     <input type="text" name="bid" placeholder="Enter bid amount" />
     <input type="submit" value="submit" name="submit"/>
</form>

<section class="details"></section>
<form action="review.php" method="POST"  class="reviews">
     <input type="text" name="review_customer" placeholder="Enter user review" />
     <input type="submit" value="submit" name="submit"/>
</form>


<section class="description">
<p><?php echo $auction['description']; ?></p>
</section>

<?php
}
?>
</section>
</article>


<?php
$stmt = $pdo->prepare('SELECT * FROM users');

$stmt->execute();

while ($users = $stmt->fetch()) {

	if ($users['email'] == $_SESSION['email']) {
		$id = $users['id'];
	}
}


$stmt = $pdo->prepare('SELECT * FROM review WHERE userId = :id');

$values = [
'id' => $id
];

$stmt->execute($values);
?>
<h1> Reviews of user </h1>
<?php

while ($review = $stmt->fetch()) {

	if ($review['userId'] == $id && $review['auctionId'] == $_SESSION['auctionId']) {
          echo '<li>' . $review['review_customer'] . '</li>';
	}
}



$stmtbid = $pdo->prepare('SELECT * FROM bid WHERE userId = :id');

$stmtbid->execute($values);
?>
<h1> Bids of user </h1>

<?php

while ($bid = $stmtbid->fetch()) {

	if ($bid['userId'] == $id && $bid['auctionId'] == $_SESSION['auctionId']) {
          echo '<li>' . $bid['bid'] . '</li>';
	}
}

$stmtmaxbid = $pdo->prepare('SELECT MAX(bid) AS bid FROM bid WHERE auctionId = :auctionId');

$auction = [
     'auctionId' => $_SESSION['auctionId']
];
$stmtmaxbid->execute($auction);

while ($maxbid = $stmtmaxbid->fetch()) {

          echo '<h1>' . 'Max users bid is ' . $maxbid['bid'] . '</h1>';
}

?>

</article>

<?php
 
require 'footer.php';
?>

</html>