<?php

include('./connect.php');

// User Operations
function addUser($username, $email, $password) {
    global $conn;
    $date = date('Y-m-d');
    $stmt = $conn->prepare("INSERT INTO User (username, email, password, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username , $email, $password, $date);
    
    if ($stmt->execute()) {
      echo "New record created successfully";
      return true;
    } else {
      echo "Error: " . $stmt->error;
      return false;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

// function removeUser($username) {
//     include('./connect.php');
//     echo "Hello world!";

//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);
// }

function findUser($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM User WHERE username = ?");
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        $stmt->store_result();
        $stmt->bind_result($id, $username, $email, $pwd, $date);
        return $stmt;
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
    global $conn;
    $stmt = $conn->prepare("SELECT u_id FROM User WHERE email = ?");
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
    $conn->close();
}


?>