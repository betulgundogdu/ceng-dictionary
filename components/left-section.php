<div class="left container">
    <div class="left wrapper">
        <div class="categories">
            <?php 
                include('./connect.php');

                $sql = "SELECT c_id, title FROM Category";
                $result = $mysqli -> query($sql);

                if ($result-> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                        if($row['c_id'] == $category){
                            echo  "<div class='item active'><a href='?category=". $row['c_id'] . "'>" . $row['title'] . "</a></div>"; 
                        } else {
                            echo  "<div class='item'><a href='?category=". $row['c_id'] . "'> " . $row['title'] . "</a></div>";
                        }
                    }
                } else {    
                    echo "0 results";
                }      
                $mysqli->close();        
            ?>
            <div class="item"><a href="category.html"> daha fazla </a></div>
            <div class="item"><button type="submit"><i class="fa fa-search"></i></button></div>
            <div class="settings">
            <?php
                // Initialize the session
                session_start();
                
                // Check if the user is logged in, if not then redirect him to login page
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    echo '                 
                        <a href="?page=login" class="item"> giriş</a>
                        <a href="?page=signup" class="item"> kayıt ol</a>
                    ';
                } else {
                    echo '
                        <a class="item" href="?page=add-header">yeni başlık</a>
                        <a class="item">profilim</a>
                        <a class="item" href="?page=logout">çıkış</a>  
                    ';
                }
            ?>

            </div>
        </div>
        <ul class="subjects">
            <?php 
                include('./connect.php');
                $category = $_GET['category'];
                if($category == ""){
                    $category = 1;
                }
                $stmt = $mysqli->prepare("SELECT h_id, title FROM Header WHERE c_id = ?");
                $stmt->bind_param("s", $category);
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    if (count($result) > 0) {
                        while($row = $result -> fetch_assoc()) {
                            echo  "<li class='item'><a href='?page=entry&entry=". $row['h_id'] . "'>" . $row['title'] . "</a></li>";
                        }
                    } else {    
                        echo "0 results";
                    }  
                    $stmt->close();    
                    $mysqli->close();               
                } else {
                    echo "Error: " . $this->stmt->error;
                }

      
            ?>
            <!-- <li class="item"><a href="entry.php"> deneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> #deneme bir kideneme bir ki</a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki deneme bir kideneme bir ki  </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki  </a></li>
            <li class="item"><a href="entry.php"> #deneme bir kideneme bir ki  </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki  </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki deneme bir kideneme bir ki  </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir ki </a></li>
            <li class="item"><a href="entry.php"> deneme bir kideneme bir ki </a></li> 
            <li class="item more"><a href="#"> daha fazla  </a></li> -->
        </ul>
    </div>
</div>