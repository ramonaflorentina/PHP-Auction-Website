<?php 
$server = 'mysql';
$username = 'student';
$password = 'student';
$schema = 'assignment1';

$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

?>

<!DOCTYPE html>
<html>
	<head>
		<title> <?php echo $title ?>
	</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>

		<nav>

		<?php

$stmt = $pdo->prepare('SELECT * FROM category WHERE name = name');

$stmt->execute();
echo '<ul>';
while ($category = $stmt->fetch())


{
    echo '<li><a class="categoryLink" href="viewCategory.php?name=' . $category['name'] . '">' . $category['name'] .'</a></li>';
   }

	 ?>

		</nav>
		<img src="banners/1.jpg" alt="Banner" />

		<main>