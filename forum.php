  <?php
  $name = $comment = $time = "";
  date_default_timezone_set('Asia/Singapore');
  if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $comment = $_POST["comment"];
    $time = date('d-m-Y \a\t h:i A');
    $conn = connect();
    $conn->query("INSERT INTO comments(name, time, content) VALUES ('". $name ."', '".$time."', '".$comment."')");
    $conn->close();
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

  function getAll() {
    $conn = connect();
    $result = $conn->query("SELECT * FROM comments");
    $conn->close();
    return $result;
  }
?>

<html>
  <head>
    <title>XSS</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="navbar navbar-default">
      <div class="container">
        <ul class="nav navbar-nav">
          <li><a href="index.php" role="button">Home</a></li>
          <li><a href="sql.php" role="button">SQL Injection</a></li>
          <li><a href="forum.php" role="button">XSS</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <h1>Forum</h1>
      <div class="jumbotron">
        <div>
          <form action="" method="POST" class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2">Name</label>
              <div class="col-sm-10">
                <input name="name" type="text" class="form-control" id="inputName" placeholder="Your name here">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-2">Comment</label>
              <div class="col-sm-10">
                <textarea name="comment" class="form-control" id="textComment" rows="5" placeholder="Your comment here"></textarea>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <div class="comments">
        <?php
          if($result = getAll()){
            foreach ($result as $data) {
              echo '<div class="comment-entry">';
              echo "<div class=\"comment-header\"><span class=\"comment-name\">".  $data['name'] . "</span><span class=\"comment-time\">" . $data['time'] . "</span></div>";
              echo "<div class=\"comment-content\">" . $data['content'] . "</div></div>";
            }
          }
        ?>
      </div>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
