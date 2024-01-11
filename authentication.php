<?php
session_start();
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "gitformed";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else if( isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailQuery = "SELECT * FROM user WHERE email='$email' && password='$password'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "Authentication Successful";
        $row = $result->fetch_assoc();
        $_SESSION["owner"] = $row["username"];
        echo "<script>window.location.href = 'repository.php';</script>";
    } else {
        echo "Please input right email and password";
    }

    
} else{
    echo "failed";
}
$conn->close();
?>