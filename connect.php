<?php
  $servername = "127.0.0.1";
  $admin = "root";
  $psw = "root";
  $dbname = "ceng_dict";

  // Create connection
  $mysqli = new mysqli($servername, $admin, $psw, $dbname);
  // Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

?>