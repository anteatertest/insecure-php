<?php
  date_default_timezone_set('Asia/Singapore');
  session_start();
  $status = 0;

  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])){
    $conn = connect();

    if(isset($_POST["signin"])){
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password = hash('sha256', $password);
      $result = $conn->query("SELECT * FROM accounts where email='$email'");
      $row = mysqli_fetch_array($result);
      if($row){
        if(strcmp($row['password'],$password)==0){
          $_SESSION['user_id'] = $row['id'];
          $_SESSION['user_name'] = $row['email'];
          $conn->query("INSERT INTO cookies(email) VALUES ('$email')");
          $conn->close();
          header("Location:login.php");
        } else {
          $status = -1;
        }
      } else {
        $status = -1;
      }
    }

    if(isset($_POST["signup"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      $password = hash('sha256', $password);
      $check = mysqli_fetch_array($conn->query("SELECT * FROM accounts where email='$email'"));
      if (!empty($check)) {
        $status = 2;
      } else {
        $conn->query("INSERT INTO accounts(email, password) VALUES ('$email', '$password')");
        $status = 1;
      }
    }
  }
  else {
    $conn = connect();
    $check = mysqli_fetch_array($conn->query("SELECT * FROM cookies where email='$email'"));
    $conn->close();
    if (!empty($check)) {
      header("Location:login.php");
    } else {
      session_regenerate_id();
      unset($_SESSION["user_id"]);
      unset($_SESSION["user_name"]);
      header("Location:index.php");
    }
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
    if ($status == 1) {
      echo '<div class="container"><div class="alert alert-success" role="alert">Sign up sucessful as '.$email.'!</div></div>';
    } else if ($status == 2) {
      echo '<div class="container"><div class="alert alert-danger" role="alert">Sign up failed!</div></div>';
    } else if ($status == -1) {
      echo '<div class="container"><div class="alert alert-danger" role="alert">Wrong username or password!</div></div>';
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
