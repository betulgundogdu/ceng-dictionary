<?php

include('./connect.php');

// User Operations
function addUser($username, $email, $password) {
    global $mysqli;
    $date = date('Y-m-d');
    $stmt = $mysqli->prepare("INSERT INTO User (username, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username , $email, $password, $date);
    
    if ($stmt->execute()) {
      echo "New record created successfully";
      return true;
    } else {
      echo "Error: " . $stmt->error;
      return false;
    }

    $stmt->close();
    $mysqli->close();
}

// function removeUser($username) {
//     include('./connect.php');
//     echo "Hello world!";

//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);
// }

function findUser($username){
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT * FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $resultarr = $result->fetch_all(MYSQLI_ASSOC);
        return $resultarr;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// function updateUser($username, $email, $password){
//     include('./connect.php');

//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);

// }

function isValidEmail($email){
    global $mysqli;
    $stmt = $mysqli->prepare("SELECT u_id FROM User WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($id);
        $count = $stmt-> num_rows;
        if($count > 0){
            return false;
        }
        else {
            return true;
        }
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $mysqli->close();
}

//Header operations
function createHeader($title, $entry) {
    global $mysqli;
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO Header (username, ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username , $email, $password, $date);
    
    if ($stmt->execute()) {
      echo "New record created successfully";
      return true;
    } else {
      echo "Error: " . $stmt->error;
      return false;
    }

    $stmt->close();
    $mysqli->close();
}


//Entry operations
function addEntry($h_id, $text, $created_date, $u_id) {
    global $mysqli;
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO Header (h_id, text, created_date, u_id ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $h_id , $text, $created_date, $u_id);
    
    if ($stmt->execute()) {
      echo "New entry added successfully";
      return true;
    } else {
      echo "Error: " . $stmt->error;
      return false;
    }

    $stmt->close();
    $mysqli->close();
}



?>