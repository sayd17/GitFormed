<?php

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
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkEmailQuery = "SELECT * FROM user WHERE email='$email' ";
    $result = $conn->query($checkEmailQuery);
    if ($result->num_rows > 0) {
        echo "Email already exists. Please use a different email.";
        exit();
    }

    $checkUsernameQuery = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($checkUsernameQuery);
    if ($result->num_rows > 0) {
        echo "Username already exists. Please use a different username.";
        exit();
    }

    // Insert new user into the database
    $insertQuery = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Registration successful!";
        readfile("./login.php");
        
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    
} else{
    echo "failed";
}
$conn->close();
?>