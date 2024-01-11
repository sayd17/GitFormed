<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Pull Requests</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
    <h2><a href="./dashboard.html">Dashboard</a></h2>
      <!-- // Task 6: add watch button. when someone click this button, add data to watcher table and 
                  subtask-1: when someone click this button check if data is already in watcher table
                  subtask-2: if is not present in watcher table, add data to watcher table and increment
                              number of watcher by one in repository table [] -->
      <form action="watch_repo.php" method="post">
        <!-- // <label> Watch Repository </label> -->
        
        <button type="submit" name="submit"> Watch Repository </button>
      </form>

      <h2>Pull Requests</h2>
      <!-- //Task 4: repo_owner from session and current_username from session_abort
      // if both are equal then get access to form -->
      <form action="create_pull_request.php" method="post">
        <div class="input-group">
          <label for="title">Create New Pull Request:</label>
          <input type="text" id="title" name="title" />
          <button type="submit" name="submit">Create</button>
        </div>
      </form>
      <br>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Time of Creation</th>
          </tr>
        </thead>
        <tbody>

        <?php

        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "gitformed";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        if ($conn->connect_error) { die("Connection failed: " .
        $conn->connect_error); } 
      

        // tasks 3: session owner and repo_name will be used for finding from pullRequest table
        $current_repo = $_GET["repo"];
        $repo_owner = $_GET["repoOwner"]; 
        $currentUser = $_SESSION["owner"];
        $_SESSION["current_repo"] = $current_repo;
        $_SESSION["repo_owner"] = $repo_owner;

        if($currentUser != $repo_owner){
          echo "current user = $currentUser "."repo owner = $repo_owner"."<br>";
          echo "You are not authorized to create pull request";
          echo "<script>window.location.href = 'repository.php';</script>";
          exit();
        }
        $queryAll = "SELECT * FROM pullRequest WHERE owner = '$repo_owner' && repo_name='$current_repo'";
        $result = $conn->query($queryAll); 
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["title"] . "</td>";
              echo "<td>" . $row["time_of_creation"] . "</td>";
              echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        $conn->close();
        ?>

        </tbody>
      </table>
    </div>
  </body>
</html>
