<?php    
    class DBActions {

        public function __construct($mysqli){
            $this->conn = $mysqli;
            $this->stmt = $this->conn->stmt_init();
        }

        //user operations
        public function addUser($username, $email, $password) {
            $date = date('Y-m-d');
            $this->stmt = $this->conn->prepare("INSERT INTO User (username, email, password, created_at) VALUES (?, ?, ?, ?)");
            $this->stmt->bind_param("ssss", $username , $email, $password, $date);
            if ($this->stmt->execute()) {
              echo "New record created successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }       
            $this->stmt->close();
        }
        
        public function getUser($username){
            $this->stmt = $this->conn->prepare("SELECT * FROM User WHERE username = ?");
            $this->stmt->bind_param("s", $username);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result(); // get the mysqli result
                $resultarr = $result->fetch_assoc();
                $this->stmt->close();
                return $resultarr;
            } else {
                $this->stmt->close();
                echo "Error: " . $this->stmt->error;
            }
        }
        
        //category operations
        public function getAllCategories(){
            $sql = "SELECT c_id, title FROM Category";
            $result = $this->conn->query($sql);
            return $result;
        }

        //header operations
        public function addHeader($title, $c_id) {
            $this->stmt = $this->conn->prepare("INSERT INTO Header (title, c_id) VALUES (?, ?)");
            $this->stmt->bind_param("si", $title, $c_id);
            
            if ($this->stmt->execute()) {
              echo "New record created successfully";
              $this->stmt->close(); 
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              $this->stmt->close();
              return false;
            }
        
        }

        public function getHeaderWithTitle($title){
            $this->stmt = $this->conn->prepare("SELECT * FROM Header WHERE title = ?");
            $this->stmt->bind_param("s", $title);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result(); // get the mysqli result
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
                $this->stmt->close();    
            }
        }
        
        public function getHeaderWithId($h_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM Header WHERE h_id = ?");
            $this->stmt->bind_param("s", $h_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result(); // get the mysqli result
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
                $this->stmt->close();    
            }
        }        

        public function getAllHeaders($c_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM Header WHERE c_id = ?");
            $this->stmt->bind_param("s", $c_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
            }
        }
        
        //entry operations
        public function addEntry($h_id, $text, $u_id) {
            $created_date = date('Y-m-d');
            $this->stmt = $this->conn->prepare("INSERT INTO Entry (h_id, text, created_date, u_id ) VALUES (?, ?, ?, ?)");
            $this->stmt->bind_param("ssss", $h_id , $text, $created_date, $u_id);
            
            if ($this->stmt->execute()) {
              $this->stmt->close();
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              $this->stmt->close();
              return false;
            } 
        }

        public function getAllEntries($h_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM Entry WHERE h_id = ?");
            $this->stmt->bind_param("s", $h_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                $this->stmt->close();
                echo "Error: " . $this->stmt->error;
            }
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
