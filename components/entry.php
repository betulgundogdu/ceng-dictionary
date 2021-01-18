<?php
    global $mysqli;
    $h_id = $_GET['baslik'];
    $category = $_GET['category'];

    $dbActions = new DBActions($mysqli);
    $header = $dbActions->getHeaderWithId($h_id);
    $header_info = $header->fetch_assoc();
    $h_title = $header_info['title'];
?>

<div class="title"> 
    <div><?php echo $h_title ?></div>
    <?php
    if($current_user_type == 'admin' || $current_user_type == 'mod'){ 
        echo '<a class="edit"> düzenle </a>|<a class="edit"> sil</a> <!-- sadece mod/admin--> ';
    } ?>
</div>

<div class="entries">
<?php
    $entries = $dbActions->getAllEntries($h_id);
    if (count($entries) > 0) {
        while($row = $entries->fetch_assoc()) {
            $uid_owner = $row['u_id'];
            $user_result = $dbActions->getUserWithId($uid_owner);
            $user_owner = $user_result->fetch_assoc();
            $username_owner = $user_owner['username'];

            echo('
                <div class="entry">
                    <p class="entry-content"> ' . $row["text"] . '</p>
                    <div class="right detail">
                        <a class="username" href="?page=profil&user=' . $username_owner . ' "> ' . $username_owner . '</a>
                        <span class="time"> | ' . $row["created_date"] . '</span> ');
                        if($current_user_type == 'admin' || $current_user_type == 'mod' || $session_username  == $username_owner){ 
                            echo '<span> | <a class="edit"> delete </a></span> <!--mod ve admin--> ';
                        } 
            echo ('
                    </div>
                </div>                     
            ');
        }
    } else {    
        echo "No entry";
    }  

    //Form for adding entry 
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
        $u_id = $_SESSION['id'];
        echo '
        <form class="entry-form" method="POST">  <!-- sadece üyeler-->
            <label for="lname">entry gir:</label><br/>
            <textarea id="entry" name="entry" rows="10" cols="30"></textarea><br/>
            <input type="submit" value="gönder"/>
        </form> '; 
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($h_id)){
            if(empty(trim($_POST["entry"]))){
                $text_err = "Please enter a text.";
            }
            else {
                $entry = trim($_POST["entry"]);
                $dbActions->addEntry($h_id, $entry, $u_id);
                header("location: index.php?page=entry&category=". $category ."&baslik=". $h_id);
   
            }
        }
    }
?>
</div>

<div class="page-count">
    <select>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select> / 
    <button class="last-page">5</button>
    <button class="next-page">></button>
</div>