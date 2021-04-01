<?php
require_once ('header.php');

// Include config file
require_once ("connect.php");
$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirm_password"]);
$username = trim($_POST["username"]);
 

    
    // Check input errors before inserting in database
    if(!empty($username) && !empty($password) && $confirm_password == $password){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
         
        if($stmt = $db->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
        
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
    }
    else {
        echo "<p> Please provide login name and password! </p>";
    }
    
    // Close connection
    $stmt->closeCursor(); 


require_once ('footer.php');
?>
