<?php
  session_start();
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])){
    header("Location:index.php");
  }
  echo session_id();
?>

<html>
<head>
  <title>Login Page</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="navbar navbar-default">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="sql.php" role="button">SQL Injection</a></li>
        <li><a href="forum.php" role="button">XSS</a></li>
        <li><a href="logout.php" role="button">Logout</a></li>
      </ul>
    </div>
  </div>

  <div class="welcome">
    <div class="container">
      <div class="row">
        <div class="col-md-16">
          <p>Welcome <?php echo $_SESSION["user_name"];?>!</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>