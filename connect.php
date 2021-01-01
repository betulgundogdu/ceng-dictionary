<?php
  $servername = "localhost";
  $admin = "root";
  $psw = "root";
  $dbname = "ceng_dict";

  // Create connection
  $conn = new mysqli($servername, $admin, $psw, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

?>