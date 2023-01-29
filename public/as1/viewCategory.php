<?php
$title = 'View Category';
require 'header.php';

$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);


$stmt = $pdo->prepare('SELECT * FROM category WHERE name = :name');
$stmt2 = $pdo->prepare('SELECT * FROM auction WHERE categoryId = :id');

$values = [
 'name' => $_GET['name']
];
$stmt->execute($values);
while ($category = $stmt->fetch()) {
  if ($category['name'] == $_GET['name']) {
    $id = $category['id'];
  } 
}


$values2 = [
  'id' => $id
 ];

$stmt2->execute($values2);

echo '<ul>';

foreach ($stmt as $category) {
 echo '<li>' . $category['name'] .'</li>';
}
echo '</ul>';


foreach ($stmt2 as $auction) {
  echo '<li>' . $auction['title'] .'</li>';
 }
 echo '</ul>';
 

require 'footer.php';
?>