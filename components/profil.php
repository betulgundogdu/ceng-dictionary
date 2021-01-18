 <?php 
    //page owner
    $profil_owner = $_GET['user'];
    $user = $dbActions->getUserWithName($profil_owner);
    $user_info = $user->fetch_assoc();
    $user_id = $user_info['u_id'];
    $entries_result = $dbActions->getEntriesByUserId($user_id);
 ?>
 
<div class="title info"> 
    <div><?php echo($profil_owner) ?></div>
    <?php
    if($current_user_type == 'admin' && $session_username != $profil_owner){ 
        echo '
        <button type="button" class="edit"> yetkilendir </a> | <button type="button" class="edit"> banla</a> <!-- sadece admin--> ';
    }
    ?>
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