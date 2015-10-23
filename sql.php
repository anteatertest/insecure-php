<?php
   // define variables and set to empty values
$matric = $mcode = $grade = "";

if (isset($_POST["submit"])) {
  $matric = $_POST["matric"];
  $mcode = $_POST["mcode"];
  $grade = $_POST["grade"];

  $conn = connect();
  $sql = "INSERT INTO users(matric, mcode, grade)
          VALUES (\"$matric\", \"$mcode\", \"$grade\");";
  $conn->query($sql);
  $conn->close();
}


function connect() {
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

function getAll() {
  $conn = connect();
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);
  $conn->close();
  return $result;
}

function printTable() {
  echo "<table class='table'>
  <tr>
  <th>Matric</th>
  <th>Module</th>
  <th>Grade</th>
  </tr>";

  if ($result = getAll()) {
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
?>

<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body> 

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
        <input type="submit" class="btn btn-info" id="button" name="submit" value="Submit">
      </form>
    </div>
  </div>

  <div class="table">
    <div = class="container">
      <?php printTable();?>
    </div>
  </div>
</body>
</html>
