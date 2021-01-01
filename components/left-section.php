<div class="left container">
    <div class="left wrapper">
        <div class="categories">
            <?php 
                include('./connect.php');

                $sql = "SELECT title FROM Category";
                $result = $conn -> query($sql);

                if ($result-> num_rows > 0) {
                    // output data of each row
                    while($row = $result -> fetch_assoc()) {
                        echo  "<div class='item'><a href='category.html'> #" . $row['title'] . "</a></div>";
                    }
                } else {    
                    echo "0 results";
                }      
                $conn->close();        
            ?>
            <div class="item"><a href="category.html"> daha fazla </a></div>
            <div class="item"><button type="submit"><i class="fa fa-search"></i></button></div>
            <form class="settings">
                <a href="?page=login" class="item"> giriş</a>
                <a href="?page=signup" class="item"> kayıt ol</a>
            </form>
            <div class="user-settings"> <!-- sadece üyeler-->
                <button class="subject-btn">yeni başlık</button>
                <button class="subject-btn">profilim</button>
                <button class="subject-btn">çıkış</button>               
            </div>

        </div>
        <ul class="subjects">
            <?php 
                include('./connect.php');

                $sql = "SELECT title FROM Header";
                $result = $conn -> query($sql);

                if ($result-> num_rows > 0) {
                    // output data of each row
                    while($row = $result -> fetch_assoc()) {
                        echo  "<li class='item'><a href='entry.php'>" . $row['title'] . "</a></li>";
                    }
                } else {    
                    echo "0 results";
                }      
                $conn->close();        
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