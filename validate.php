<?php 

require_once('connect.php');


//define a flag variable 
$ok = true; 

// grab the information from the form and also validate 

$username = trim(filter_input(INPUT_POST, 'username')); 
$password = trim(filter_input(INPUT_POST, 'password'));

if(empty($username)) {
    echo "<p> Please provide your username! </p>"; 
    $ok = false; 
}
if(empty($password)){
    echo "<p> Please provide your password! </p>"; 
    $ok = false; 
}

//validate the credentials 

if($ok === true ) {
    //set up query to see if a username matches 
    $sql = "SELECT id, username, password FROM users WHERE username = :username AND password = :password;"; 
    //prepare 
    $stmt = $db->prepare($sql); 
    //bind 
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    //execute
    $stmt->execute(); 
    if($username=="bob")
    {
        echo "<p> Login Successful </p>";
        echo "<a href='logout.php' class='btn btn-secondary'> Log Out </a> ";
    }
    else {
        echo "<p> Login Invalid! </p>"; 
    }
}
else {
    echo "Sorry, something went wrong!"; 
}
  
$stmt->closeCursor();
?>