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
else if( isset($_POST['submit']) ) {
    $repo_name = $_POST['repositoryName'];
    $no_of_watchers = 1;
    $pattern = "/^[A-Za-z0-9-_]{5,10}$/";
    if(!preg_match($pattern, $repo_name)){
        echo "The name must match the pattern [A-Za-z0-9-_]{5, 10}";
        sleep(1);
        readfile("./createRepo.html");
        exit();
    } 
    $owner = $_SESSION["owner"];
    $checkRepositoryQuery = "SELECT * FROM repository WHERE repo_name='$repo_name' && owner='$owner'";
    $result = $conn->query($checkRepositoryQuery);
    if ($result->num_rows > 0) {
        echo "Repository already exists. Please use a different repository name.";
        readfile("./createRepo.html");
        exit();
    }
    
    // Insert new user into the database";
    $insertQuery = "INSERT INTO repository (owner, repo_name, no_of_watchers) VALUES ('$owner', '$repo_name', '$no_of_watchers')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Repository created successfully!";
        sleep(1);
        echo "<script>window.location.href = 'repository.php';</script>";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

   
} 
$conn->close();
?>