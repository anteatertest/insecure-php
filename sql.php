<?php
  session_start();
  if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])){
    header("Location:index.php");
}

function connect() {
  $servername = "localhost";
  $username = "admin";
  $password = "admin";
  $dbname = "cs3235";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
  }

  return $conn;
}

function getData($matric) {
  $conn = connect();
  $result = mysqli_query($conn, "SELECT matric, mcode, grade FROM users WHERE matric='$matric'");
  mysqli_close($conn);
  return $result;
}

function printData($matric) {
  echo "<table class='table'>
  <tr>
  <th>Matric</th>
  <th>Module</th>
  <th>Grade</th>
  </tr>";

  if ($result = getData($matric)) {
    foreach($result as $data) {
      echo "<tr>";
      echo "<td>" . $data['matric'] . "</td>";
      echo "<td>" . $data['mcode'] . "</td>";
      echo "<td>" . $data['grade'] . "</td>";
      echo "</tr>";
    }
  }
  echo "</table>";
}

function printTable() {
  $matric = $mcode = $grade = "";

  if (isset($_POST["submit"])) {
    $matric = $_POST["matric"];
    $mcode = $_POST["mcode"];
    $grade = $_POST["grade"];

    $conn = connect();
    mysqli_query($conn, "INSERT INTO users(matric, mcode, grade) VALUES ('$matric', '$mcode', '$grade')");
    mysqli_close($conn);

    printData($matric);
  }

  if (isset($_POST["show"])) {
    $matric = $_POST["matric"];

    printData($matric);
  }
}
?>

<html>
<head>
  <title>SQL Injection</title>
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
  <div class = "form">
    <div class = "container">
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
          <label for="inputMatric">Matric Number</label>
          <input type="text" class="form-control" id="inputMatric" name="matric">
        </div>
        <div class="form-group">
          <label for="inputModuleCode">Module Code</label>
          <input type="text" class="form-control" id="inputModuleCode" name="mcode">
        </div>
        <div class="form-group">
          <label for="inputGrade">Grade</label>
          <input type="text" class="form-control" id="inputGrade" name="grade">
        </div>
        <input type="submit" class="btn btn-primary" name="show" value="Show">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </div>

  <div class="table">
    <div = class="container">
      <?php printTable();?>
    </div>
  </div>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
