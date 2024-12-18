<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="login.css">
  <title>Admin Login</title>
</head>

<body>
  <form action="login.php" method="post">
    <div class="login-box">
      <h1>Admin Login</h1>

      <?php
        // Display error message if available from URL parameter
        if (isset($_GET['error']) && $_GET['error'] == 'invalid') {
          echo "<p style='color: red;'>Invalid credentials. Please try again.</p>";
        }
      ?>

      <div class="textbox">
        <i class="fa fa-user" aria-hidden="true"></i>
        <input type="text" placeholder="Username" name="username" value="">
      </div>

      <div class="textbox">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="password" placeholder="password" name="password" value="">
      </div>

      <input class="button" type="submit" name="login" value="Sign In">
    </div>
  </form>
</body>

</html>
