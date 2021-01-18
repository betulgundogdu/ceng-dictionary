<?php
    $username = $_SESSION['username'];
    $dbActions = new DBActions($mysqli);
    $category = $_GET['category'];
    if($category == ""){
        $category = 1;
    }
?>

<div class="left container">
    <div class="left wrapper">
        <div class="tools">
        <div class="categories">
            <?php 
                $result = $dbActions->getAllCategories();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['c_id'] == $category){
                            echo  "<div class='item active'><a href='?category=". $row['c_id'] . "'>#" . $row['title'] . "</a></div>"; 
                        } else {
                            echo  "<div class='item'><a href='?category=". $row['c_id'] . "'>#" . $row['title'] . "</a></div>";
                        }
                    }
                } else {    
                    echo "0 results";
                }      
            ?>
            <!-- <div class="item"><a href="category.html"> daha fazla </a></div>  -->
            <div class="item"><button type="submit" class="icon"><ion-icon name="search-sharp" ></ion-icon></button></div>
            </div>
            <div class="settings">
            <?php
                // Initialize the session
                
                // Check if the user is logged in, if not then redirect him to login page
                if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                    echo '                
                        <a href="?page=login" class="item"> giriş</a>
                        <a href="?page=signup" class="item"> kayıt ol</a>
                    ';
                } else {
                    echo '
                        <div class="item">
                            <a href="?page=messages" class="icon">
                                <ion-icon name="chatbox-outline"></ion-icon>
                                <!-- <ion-icon name="chatbox"></ion-icon> -->
                            </a>
                        </div> 
                        <a class="item" href="?page=add-header">yeni başlık</a>
                        <a class="item" href="?page=profil&user='. $username . '">profilim</a>
                        <a class="item" href="?page=logout">çıkış</a>  
                    ';
                }
            ?>

            </div>
        </div>
        <ul class="subjects">
            <?php 
                $result = $dbActions->getAllHeaders($category);
                if (count($result) > 0) {
                    while($row = $result -> fetch_assoc()) {
                        echo  "<li class='item '><a href='?page=entry&category=". $category ."&baslik=". $row['h_id'] . "'> >   " . $row['title'] . "</a></li>";
                    }
                } else {    
                    echo "0 results";
                }  
            ?>

        </ul>
    </div>
</div>