<?php
  date_default_timezone_set('Asia/Singapore');
  session_start();
  $login = 0;

  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])){
    if(isset($_POST["signin"])){
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password = hash('sha256', $password);
      $conn = connect();
      $result = $conn->query("SELECT * FROM accounts where email='$email'");
      $conn->close();
      $row = mysqli_fetch_array($result);
      if($row){
        if(strcmp($row['password'],$password)==0){
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_name'] = $row['email'];
          header("Location:login.php");
        }
        else {
          $login = -1;
        }
      }
    }

    if(isset($_POST["signup"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password = hash('sha256', $password);
      $conn = connect();
      $conn->query("INSERT INTO accounts(email, password) VALUES ('$email', '$password')");
      $conn->close();
    }
  }
  else {
    header("Location:login.php");
  }

  function connect(){
    $servername = "localhost";
    $username = "admin";
    $password = "admin";
    $dbname = "cs3235";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }
?>

<html>
<head>
  <title>Insecure Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>

<body>
  <div class="navbar navbar-default">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="#" role="button">Home</a></li>
        <li><a href="sql.php" role="button">SQL Injection</a></li>
        <li><a href="forum.php" role="button">XSS</a></li>
      </ul>
    </div>
  </div>
  <?php
    if($login==1){
      echo '<div class="alert alert-success" role="alert">You have logged in as '.$email.'!</div>';
    } else if($login==-1){
      echo '<div class="alert alert-danger" role="alert">Wrong username or password!</div>';
    }
  ?>
  <div class="container">
    <div class="jumbotron col-sm-6 col-sm-offset-3">
      <form action="" method="POST" class="form-horizontal">
        <div class="form-group">
          <label for="emailAccount" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="emailAccount" placeholder="Enter your email">
          </div>
        </div>
        <div class="form-group">
          <label for="passwordAccount" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="passwordAccount" placeholder="Enter your password">
          </div>
        </div>
        <input type="submit" class="btn btn-primary" name="signin" value="Sign In">
        <button type="submit" class="btn btn-primary" name="signup">Sign Up</button>
      </form>
    </div>
  </div>

</body>
</html>
