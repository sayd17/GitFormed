<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Repository Page</title>
    <link rel="stylesheet" href="style.css" />

  </head>
  <body>
    <div class="container">
    <h2><a href="./dashboard.html">Dashboard</a></h2>

      <h2>Repositories</h2>
      <a href="./createRepo.html" class="create-btn">Create Repository</a>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="owner" value="Sort By Username">
        <input type="submit" name="no_of_watcher" value="Sort By number_of_watcher">
        <input type="submit" name="time" value="Sort By Date_and_Time">
        <input type="submit" name="myRepo" value="My Repositories"> <br>
        
      </form>
      <table>
        <thead>
          <tr>
            <th>Repository Name</th>
            <th>Number of Watchers</th>
            <th>Date and Time of Creation</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Sorting 
            $page = $_GET["page"];
            if($page=="" || $page=="1"){
              $page1 = 0;
            }else{
              $page1 = ($page*10)-10;
            }
            // Task 8: subtask-1: add mywatched option
            //         subtask-2: (nested query) from watcher table take all repo_name and owner name 
            //                     for current user, and match this reponame and owner name with repository table 
            //                     and show the matched data in table
            //          "select * from repository as R, watcher as W where R.owner  = W.owner && R.reponame= W.reponame and W.username = '$_SESSION['$current_user'] Limit $page1, 10"
            if(isset ($_POST['myRepo'])){
              
              $owner = $_SESSION['owner'];
              $owner_query = "SELECT * FROM repository where owner='$owner' LIMIT $page1, 10";
              $result = executeQuery($owner_query);
            }
            else if(isset($_POST['owner']))
            {
                $owner_query = "SELECT * FROM repository ORDER BY owner ASC LIMIT $page1, 10";
                $result = executeQuery($owner_query);
            }
            elseif (isset ($_POST['no_of_watcher'])) 
            {
              $watcher_query = "SELECT * FROM repository ORDER BY no_of_watchers ASC LIMIT $page1, 10";
              $result = executeQuery($watcher_query);
            }
            else if(isset ($_POST['time'])){
              $time_query = "SELECT * FROM repository ORDER BY date_and_time_of_creation DESC LIMIT $page1, 10";
              $result = executeQuery($time_query);
            }
            else {
              $default_query = "SELECT * FROM repository LIMIT $page1, 10";
              $result = executeQuery($default_query);
            }


            function executeQuery($query)
            {
                $connect = mysqli_connect("localhost", "root", "", "gitformed");
                $result = mysqli_query($connect, $query);
                return $result;
            }
            if ($result->num_rows > 0) {

              while ($row = $result->fetch_assoc()) {
                  echo "<tr onclick='window.location=\"pullRequest.php?repo={$row["repo_name"]}&repoOwner={$row["owner"]}\"'>";
                  //<a href="./pullRequest.php">Pull Request</a>

                  echo "<td>" . $row["owner"] . "/" . $row["repo_name"] . "</td>";
                  echo "<td>" . $row["no_of_watchers"] . "</td>";
                  echo "<td>" . $row["date_and_time_of_creation"] . "</td>";
                  echo "</tr>";
              }
              

            } else {
              echo "<tr><td colspan='3'>No data found</td></tr>";
            }
          ?>
        </tbody>
      </table>
      <?php
      
      $connect = mysqli_connect("localhost", "root", "", "gitformed");
              //echo "hi";
              
              $query = "SELECT * FROM repository";
              $stmt = mysqli_prepare($connect, $query);
              mysqli_stmt_execute($stmt);

              /* store the result in an internal buffer */
              mysqli_stmt_store_result($stmt);

              $count = mysqli_stmt_num_rows($stmt);
              $a = $count / 10;
              $a = ceil($a);
              echo "<br>"; 
              for($b = 1; $b <= $a; $b++){
                ?> <a href="repository.php?page=<?php echo $b; ?>" style="text-decoration:none">  <?php echo "$b " ?> </a> <?php
              }
        
              ?>
    </div>
  </body>
</html>
