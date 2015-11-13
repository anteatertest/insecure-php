<?php
  session_start();
  $email = $_SESSION["user_name"];
  $conn = connect();
  $conn->query("DELETE FROM cookies WHERE email='$email'");
  $conn->close();
  unset($_SESSION["user_id"]);
  unset($_SESSION["user_name"]);
  header("Location:index.php");

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