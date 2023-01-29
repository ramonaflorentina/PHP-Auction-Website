<?php
session_start();

    $title = 'Delete Category';
    require 'header.php';

    $server = 'mysql';
    $username = 'student';
    $password = 'student';
    $schema = 'assignment1';
    $pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

    if (isset($_SESSION['logged in as user'])) {
        echo 'You are seeing this because you are logged in';
        $pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

?>

<article>

<h1>Delete category</h1>

</article> 

<?php

$stmt = $pdo->prepare('SELECT * FROM category');

   $stmt->execute();

   
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare('DELETE FROM category WHERE id= :id');

    $values = [
        'id' => $_POST['id']
    ];

    $stmt->execute($values); 

    echo ' Category has been deleted.  ';

}


if (isset($_POST['add'])) {
    $stmt = $pdo->prepare('INSERT INTO category(name, categoryId)
						   VALUES (:name, :id)');


    $values = [
        'name' => $_POST['name'],
        'id' => $_POST['id']
    ];

    $stmt->execute($values);

    echo 'Category added';
}

else {
?>

<form action="deleteCategory.php" method="post">
		<label>Category</label>

<?php
$stmt = $pdo-> prepare('SELECT * FROM category');
$stmt->execute();
?>
        <select name = "id"> 

<?php

foreach ($stmt as $row) {

 echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}
 ?>
</select>

<input type="submit" name="submit" value="Delete" />
<input type="button" name="add" value="Add" onclick="location.href='addCategory.php'" />

</form>

<?php
}
?>
<?php
   }

else {
	echo 'Sorry, you must be logged in to view this page.' . 'Login here: <a href="login.php">Login</a>';
 }
require 'footer.php';
?>