<?php
require_once ('header.php');

// Include config file
require_once ("connect.php");

// Create an array to hold all the field errors
$errors = [];

// Validate the recaptcha
if (!empty($_POST['recaptcha_response'])) {
  $secret = SECRETKEY;
  $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$_POST['recaptcha_response']}");
  
  $response_data = json_decode($verify_response);
  if (!$response_data->success) {
    $errors[] = "Google reCaptcha failed: " .($response_data->{'error-codes'})[0];
    error_handler($errors);
  }
}

$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirm_password"]);
$username = trim($_POST["username"]);
    
//ensure that fields are not empty
$required_fields = ['username','password','password_confirmation'];

foreach ($required_fields as $field) {
  if (empty($$field)) {
    $human_field = str_replace("_", " ", $field);
    $errors[] = "You cannot leave the {$human_field} blank.";
  } else {
    if ($field === "password" || $field === "password_confirmation") continue;
    $$field = filter_var($$field, FILTER_SANITIZE_STRING);
  }
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="The Registration"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Access Denied.";
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
      $username = strtolower($username);
      $password = password_hash($password, PASSWORD_DEFAULT);

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