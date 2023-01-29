<?php

$title = 'Category';
require 'header.php';

$pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');


$stmt = $pdo->prepare('SELECT * FROM category WHERE name = name');

$stmt->execute();
echo '<ul>';
while ($category = $stmt->fetch())


{
    echo '<li><a href="viewCategory.php?name=' . $category['name'] . '">' . $category['name'] .'</a></li>';
   }
require 'footer.php';
?>  