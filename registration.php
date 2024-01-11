<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
    <h2><a href="./dashboard.html">Dashboard</a></h2>

      <h2>Registration</h2>
      <form action="insert.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Register" />
        </div>
      </form>
    </div>
  </body>
</html>
