<?php
require_once ('header.php');

// Include config file
require_once ("connect.php");
$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirm_password"]);
$username = trim($_POST["username"]);
    


if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="The Registration"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Log in fool";
  } else {
    if ($_SERVER['PHP_AUTH_USER'] !== "bob") {
      echo "Log in with the correct username";
      exit();
    }

    if ($_SERVER['PHP_AUTH_PW'] !== "ilikepuppies") {
      echo "Log in with the correct password";
      exit;
    }

    echo "You have gained access!!!";
  }




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
