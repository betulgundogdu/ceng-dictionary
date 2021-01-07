<?php
    
    class DBActions {

        public function __construct($mysqli){
            $this->conn = $mysqli;
            $this->stmt = $this->conn->stmt_init();
        }

        //user operations
        public function addUser($username, $email, $password) {
            echo("iamherenow");
            $date = date('Y-m-d');
            $this->stmt = $this->conn->prepare("INSERT INTO User (username, email, password, created_at) VALUES (?, ?, ?, ?)");
            $this->stmt->bind_param("ssss", $username , $email, $password, $date);
            echo("iamherenowstill");
            if ($this->stmt->execute()) {
              echo "New record created successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }       
            $this->stmt->close();
        }
        
        // function removeUser($username) {
        //     include('./connect.php');
        //     echo "Hello world!";
        
        //     mysqli_stmt_close($stmt);
        //     mysqli_close($conn);
        // }
        
        public function findUser($username){
            $this->stmt = $this->conn->prepare("SELECT * FROM User WHERE username = ?");
            $this->stmt->bind_param("s", $username);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                $resultarr = $result->fetch_all(MYSQLI_ASSOC);
                return $resultarr;
            } else {
                echo "Error: " . $this->stmt->error;
            }
            $this->stmt->close();
        }
        
        // function updateUser($username, $email, $password){
        //     include('./connect.php');
        
        //     mysqli_stmt_close($stmt);
        //     mysqli_close($conn);
        
        // }
        

        //header operations
        public function createHeader($title, $entry) {
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
        
            $this->stmt->close();
        }
        
        //entry operations
        public function addEntry($h_id, $text, $created_date, $u_id) {
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
            $this->stmt->close();
        }


        //aux methods
        public function isValidEmail($email){
            $this->stmt = $this->conn->prepare("SELECT u_id FROM User WHERE email = ?");
            $this->stmt->bind_param("s", $email);
            
            if ($this->stmt->execute()) {
                $this->stmt->store_result();
                $this->stmt->bind_result($id);
                $count = $this->stmt-> num_rows;
                if($count > 0){
                    return false;
                }
                else {
                    return true;
                }
            } else {
                echo "Error: " . $this->stmt->error;
            }
            $this->stmt->close();
        }  
    }
?>
