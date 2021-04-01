<?php
try {
    //try to connect to database 
    //data source name 
    $dsn = 'mysql:host=localhost;dbname=COMP1006_Winter2021Sem';
    $username = 'root'; 
    $password = 'root';
    //create instance of PDO object
    $db = new PDO($dsn,$username, $password); 
    //echo 'Connected successfully! Whoo hoo!!!!'; 
}
catch(PDOException $e ) {
    //display error message if things go wrong! 
    $error_message = $e->getMessage();
    echo 'Something went wrong!!!' . $error_message . '!'; 
}
?>




