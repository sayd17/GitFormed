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
    $title = $_POST['title'];
    $owner = $_SESSION['owner'];
    $currentRepo = $_SESSION['current_repo'];
    $repo_owner = $_SESSION['repo_owner'];

        $Query = "INSERT INTO pullRequest (title, owner, repo_name) VALUES ('$title', '$repo_owner', '$currentRepo')";
        // Task 7: subtask-1: get watcher usernames from watcher table
                  //  subtask-2: for all username in subtask-1, add data to notification table
        if ($conn->query($Query) === TRUE) {
            echo "Pull Request Successfully Created!";
            $watcherQuery = "SELECT * FROM watcher WHERE repo_name='$currentRepo' && owner = '$repo_owner'";
            $result = $conn->query($watcherQuery);
            while($row = $result->fetch_assoc()){
                $username = $row['username'];
                $repo_name = $row['repo_name'];
                $owner = $row['owner'];
                $insertQuery = "INSERT INTO notification (username, repo_name, owner) VALUES ('$username', '$repo_name', '$owner')";
                $conn->query($insertQuery);
                echo "insertion successful";
            }
            echo "Notification Successful";


        } else {
            echo "Error: " . $Query . "<br>" . $conn->error;


        }
        
        echo "<script>window.location.href = 'pullRequest.php?repo={$currentRepo}&repoOwner={$repo_owner}'</script>";
        exit();

}
$conn->close();
?>