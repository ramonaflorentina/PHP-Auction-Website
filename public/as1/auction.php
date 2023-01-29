<?php

$title = 'Auction';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


$stmt = $pdo->prepare('SELECT * FROM auction');

$stmt->execute();
echo '<ul>';

while ($auction = $stmt->fetch())


{
    echo '<li><a class="categoryLink" href="viewauction.php?id=' . $auction['id'] . '">' . $auction['title'] .'</a></li>';
   }



require 'footer.php';
?>