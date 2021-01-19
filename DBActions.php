<?php    
    class DBActions {

        public function __construct($mysqli){
            $this->conn = $mysqli;
            $this->stmt = $this->conn->stmt_init();
        }

        // USER OPERATIONS
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
        }

        public function removeUser($u_id) {
            $this->stmt = $this->conn->prepare("DELETE FROM User WHERE u_id = ?");
            $this->stmt->bind_param("s", $u_id);
            if ($this->stmt->execute()) {
              echo "The record deleted successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }       
        }
                    
        public function getUserWithName($username){
            $this->stmt = $this->conn->prepare("SELECT * FROM User WHERE username = ?");
            $this->stmt->bind_param("s", $username);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result(); // get the mysqli result
                return $result;
            } else {
                return false;
                echo "Error: " . $this->stmt->error;
            }
        }

        public function getUserWithId($u_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM User WHERE u_id = ?");
            $this->stmt->bind_param("s", $u_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result(); // get the mysqli result
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
            }
        }

        public function updateUserType($u_id, $new_type){
            $this->stmt = $this->conn->prepare("UPDATE User
                                                SET type = ?
                                                WHERE u_id = ?");
            $this->stmt->bind_param("ss", $new_type, $u_id);
            if ($this->stmt->execute()) {
                echo "The record updated successfully";
                return true;
            } else {
                echo "Error: " . $this->stmt->error;
                return false;
            }
        }


        //CATEGORY OPERATIONS
        public function getAllCategories(){
            $sql = "SELECT c_id, title FROM Category";
            $result = $this->conn->query($sql);
            return $result;
        }        

        //HEADER OPERATIONS
        public function addHeader($title, $c_id) {
            $this->stmt = $this->conn->prepare("INSERT INTO Header (title, c_id) VALUES (?, ?)");
            $this->stmt->bind_param("si", $title, $c_id);
            
            if ($this->stmt->execute()) {
              echo "New record created successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }
        
        }

        public function removeHeader($h_id) {
            $this->stmt = $this->conn->prepare("DELETE FROM Header WHERE h_id = ?");
            $this->stmt->bind_param("s", $h_id);
            if ($this->stmt->execute()) {
              echo "The record deleted successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }       
        }

        public function updateHeader($h_id, $new_title){
            $this->stmt = $this->conn->prepare("UPDATE Header
                                                SET title = ?
                                                WHERE h_id = ?");
            $this->stmt->bind_param("ss", $new_title, $h_id);
            if ($this->stmt->execute()) {
                echo "The record updated successfully";
                return true;
            } else {
                echo "Error: " . $this->stmt->error;
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

        public function getPopularHeaders(){
            $this->stmt = $this->conn->prepare("SELECT h_id
                                                FROM Entry
                                                GROUP BY h_id
                                                ORDER BY COUNT(h_id)
                                                DESC
                                                LIMIT 9;
                                                ");
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
            } 
        }
        
        //ENTRY OPERATIONS
        public function addEntry($h_id, $text, $u_id) {
            $created_date = date('Y-m-d');
            $this->stmt = $this->conn->prepare("INSERT INTO Entry (h_id, text, created_date, u_id ) VALUES (?, ?, ?, ?)");
            $this->stmt->bind_param("ssss", $h_id , $text, $created_date, $u_id);
            
            if ($this->stmt->execute()) {
            echo "Entry added succesfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            } 
        }

        public function removeEntry($e_id) {
            $this->stmt = $this->conn->prepare("DELETE FROM Entry WHERE e_id = ?");
            $this->stmt->bind_param("s", $e_id);
            if ($this->stmt->execute()) {
              echo "The record deleted successfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            }       
        }     
        
        public function updateEntry($e_id, $new_text){
            $this->stmt = $this->conn->prepare("UPDATE Entry
                                                SET text = ?
                                                WHERE e_id = ?");
            $this->stmt->bind_param("ss", $new_text, $e_id);
            if ($this->stmt->execute()) {
                echo "The record updated successfully";
                return true;
            } else {
                echo "Error: " . $this->stmt->error;
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

        public function getEntriesByUserId($u_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM Entry WHERE u_id = ?");
            $this->stmt->bind_param("s", $u_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                $this->stmt->close();
                echo "Error: " . $this->stmt->error;
            }
        }

        public function getLastEntry($h_id){
            $this->stmt = $this->conn->prepare("SELECT * FROM Entry
                                                WHERE h_id = ?
                                                ORDER BY e_id
                                                DESC
                                                LIMIT 1");
            $this->stmt->bind_param("s", $h_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                $this->stmt->close();
                echo "Error: " . $this->stmt->error;
            }  
        }

        // MESSAGE OPERATIONS
        public function addMessage($text, $sender, $receiver){
            $created_date = date('Y-m-d H:i:s');
            $this->stmt = $this->conn->prepare("INSERT INTO Message (text, sender_id, receiver_id, created_date ) VALUES (?, ?, ?, ?)");
            $this->stmt->bind_param("ssss", $text , $sender, $receiver, $created_date);
            
            if ($this->stmt->execute()) {
            echo "Message sent succesfully";
              return true;
            } else {
              echo "Error: " . $this->stmt->error;
              return false;
            } 
        }

        public function getUsersOnMessage($u_id){
            $this->stmt = $this->conn->prepare(" SELECT DISTINCT receiver_id FROM Message
                                                 WHERE sender_id = ? 
                                                 UNION
                                                 SELECT DISTINCT sender_id FROM Message
                                                 WHERE receiver_id = ?
                                                ");
            $this->stmt->bind_param("ss", $u_id, $u_id);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
                $this->stmt->close();

            }       
        }

        public function getMessages($current_uid,$msg_uid ){
            $this->stmt = $this->conn->prepare(" SELECT * FROM Message
                                                WHERE sender_id = ? AND receiver_id = ?
                                                UNION
                                                SELECT * FROM Message
                                                WHERE sender_id = ? AND receiver_id = ?
                                                ORDER BY created_date");
            $this->stmt->bind_param("ssss", $current_uid, $msg_uid, $msg_uid, $current_uid);
            if ($this->stmt->execute()) {
                $result = $this->stmt->get_result();
                return $result;
            } else {
                echo "Error: " . $this->stmt->error;
                $this->stmt->close();

            }       
        }

        //HELPER METHODS
        public function isValidEmail($email){
            $this->stmt = $this->conn->prepare("SELECT u_id FROM User WHERE email = ?");
            $this->stmt->bind_param("s", $email);
            
            if ($this->stmt->execute()) {
                $get_result = $this->stmt->get_result();
                $result = $get_result->fetch_assoc();
                $count = $result->num_rows;
                if($count > 0){
                    return false;
                }
                else {
                    return true;
                }
            } else {
                echo "Error: " . $this->stmt->error;
            }
        }  
    }
?>
