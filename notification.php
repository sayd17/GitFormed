<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Notification</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <header> Notification for New Pull Requests </header>
        <table>
        <thead>
        <tr>
            
            <th>Owner</th>
            <th>Repository Name</th>
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
       
        $currentUser = $_SESSION["owner"];
        $_SESSION["current_repo"] = $current_repo;
        $_SESSION["repo_owner"] = $repo_owner;

        $queryAll = "SELECT * FROM notification WHERE username = '$currentUser'";
        $result = $conn->query($queryAll); 
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . $row["owner"] . "</td>";
              echo "<td>" . $row["repo_name"] . "</td>";
              echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='2'>No data found</td></tr>";
        }
        $conn->close();
        ?>

        </tbody>
      </table>
    </div>
  </body>
</html>
