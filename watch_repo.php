<?php
    session_start();

    $currentUser = $_SESSION["owner"];
    $current_repo = $_SESSION["current_repo"];
    $repo_owner = $_SESSION["repo_owner"];

    //echo "current user = $currentUser <br> current repo = $current_repo <br> repo_owner = $repo_owner <br>";

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
        $queryAll = "SELECT * FROM watcher WHERE username = '$currentUser' && repo_name='$current_repo'";
        $result = $conn->query($queryAll);
        if($result->num_rows == 0) {
            $insertQuery = "INSERT INTO watcher (repo_name, owner, username) VALUES ('$current_repo', '$repo_owner', '$currentUser')";
            if($conn->query($insertQuery) === true){
                echo "Successfully inserted into watcher table";
            }
            $repository_query = "SELECT * FROM repository WHERE owner = '$repo_owner' && repo_name = '$current_repo'";
            $result = $conn->query($repository_query);
            $row = $result->fetch_assoc();
            $increment_watch = $row['no_of_watchers'] + 1;
            $UpdateQuery = "UPDATE repository SET no_of_watchers = '$increment_watch' WHERE owner = '$repo_owner' && repo_name = '$current_repo'";
            if($conn->query($UpdateQuery) === true){
                echo "Successfully Incremented repository table";
                
            }
        }
        echo "<script>window.location.href = 'pullRequest.php?repo={$current_repo}&repoOwner={$repo_owner}';</script>";
    }
?>