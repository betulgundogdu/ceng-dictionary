<?php
    $msg_username = $_GET['user'];
    $msg_user = $dbActions->getUserWithName($msg_username);
    $msg_user_info = $msg_user->fetch_assoc();
    $msg_uid = $msg_user_info['u_id'];   
    $all_messages = $dbActions->getMessages($session_uid, $msg_uid);
?>

<div class="messaging-wrapper">
     <span><?php echo $msg_username ?> ile olan sohbet</span>
    <div class="messaging-area">
        <?php
            while($row = $all_messages->fetch_assoc()){
                $msg = $row['text'];
                $sender_id = $row['sender_id'];
                $receiver_id = $row['receiver_id'];
                $msg_date = $row['created_date'];

                if($sender_id == $session_uid){
                    echo'
                    <div class="message lighter">
                    <p class="message-text"> '. $msg . '</p>
                    <span class="time-right"> ' . $msg_date . '</span>
                    </div>
                    ';
                }

                else {
                    echo '
                    <div class="message">
                    <p class="message-text">'. $msg . '</p>
                    <span class="time-right">' . $msg_date . '</span>
                    </div> ';
                }
            } 
        ?>
    </div>
    <div class="send-message">
        <textarea id="send-msg" name="send-msg" rows="4" cols="58"  required></textarea><br/>
        <button type="submit" value="Submit">gönder</button>
    </div>
</div>