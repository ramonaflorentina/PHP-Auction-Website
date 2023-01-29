<?php
session_start();

    $title = 'Admin Category';
    require 'header.php';

    $username = 'student';
    $password = 'student';
    $schema = 'assignment1';

    $pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

    if (isset($_SESSION['logged in as user'])) {
        echo 'You are seeing this because you are logged in';
        $pdo = new PDO('mysql:dbname=assignment1;host=mysql', 'student', 'student');

    echo '<h1> Categories </h1>';
    $results = $pdo->query('SELECT * FROM category');
    foreach ($results as $row) {
        
       
        echo '<ul><li>'. $row['name'].'<a href="editCategory.php?id=' . $row['id'] . '">  Edit Category </a>';
        echo '<a href="deleteCategory.php?id=' . $row['id'] . '">  Delete Category </a>';
       
        echo'</li></ul>';
       
        
       }
        

       echo '<a href="addCategory.php"> Add Category</a>';	


}

else {
    echo 'You need to be log in as an admin! Login here: ' . '<a href="login.php">Login</a>';
}

require 'footer.php';
?>