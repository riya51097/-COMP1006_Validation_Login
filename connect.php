<?php
try {
    //try to connect to database 
    //data source name 
    $dsn = 'mysql:host=172.31.22.43;dbname=Riya200459339';
    $username = 'Riya200459339'; 
    $password = 'T0LoAepfmR';
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




