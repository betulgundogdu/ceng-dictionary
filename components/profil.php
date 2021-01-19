 <?php 
    //page owner
    $profil_owner = $_GET['user'];
    $user = $dbActions->getUserWithName($profil_owner);
    $user_info = $user->fetch_assoc();
    $user_id = $user_info['u_id'];
    $entries_result = $dbActions->getEntriesByUserId($user_id);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $flag = true;
        $auth = $_POST["auth"];
        $delete = $_POST["delete"];
        $username = $_GET['user'];
        $user = $dbActions->getUserWithName($username);
        $user_info = $user->fetch_assoc();
        $u_id = $user_info['u_id'];
        if($auth){
            $result = $dbActions->updateUserType($u_id, 'mod');
            if($result){
                header('index.php');
            }
        }

        if($delete){
            $result = $dbActions->removeUser($u_id);
            if($result){
                header('index.php');
            }
        }
    }

 ?>
 
<div class="title info"> 
    <div><?php echo($profil_owner) ?></div>
    <?php if($current_user_type == 'admin' && $session_username != $profil_owner): ?> 
        <form method="POST">
            <input type=checkbox name="auth"/>
            <span class="edit">yetkilendir</span> |
            <input type=checkbox name="delete"/>
            <span  class="edit">sil</span> 
            <button type="submit" > gönder </button> 
        </form>
        

    <?php endif; ?>

</div>
<div class="entries">
    <?php
        while($row = $entries_result->fetch_assoc()) {
            $h_id = $row['h_id']; 
            $c_id = $row['c_id'];
            $header_info = $dbActions->getHeaderWithId($h_id);
            $header = $header_info->fetch_assoc();
            $h_title = $header['title'];

            echo '
            <div class="entry">
                <a href="?page=entry&category=' . $c_id . '&baslik=' . $h_id . '" class="header"> ' . $h_title . '</a>
                <p class="entry-content"> ' . $row["text"] . '</p>
                <div class="right">
                    <span class="time"> ' . $row["created_date"] . '</span> ';
                    if($session_username == $profil_owner){   
                    echo '<a class="edit">delete </a>|<a class="edit"> edit</a> <!-- sadece userın kendisi--> ';
                    }
                    echo '
                </div>
            </div> ';
        }
    ?>
</div>

</div>