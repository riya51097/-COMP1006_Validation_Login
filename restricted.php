<?php require('header.php');
require('connect.php');
$conn = dbo();

// Create our SQL query
$sql = "SELECT * FROM users WHERE username = :username";

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$username = strtolower($username);
$stmt->bindParam(":username", $username, PDO::PARAM_STR);

$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
session_start();
$auth = false;
if (!$user) {
    $auth = false;
    header('Location: ./login.php');
    exit();
}
else{
    echo "<main>
        <h1> Members Only </h1> 
        <h2> You are logged in and not a robot! Congrats! </h2> 
        <p> However, is this page really restricted? We can simply navigate to restricted.php to view this page. How can we improve our registration/login functionality to ensure that only users who have been authenticated can view this content? 
        </p>
    </main>";

}
require('footer.php')
?>