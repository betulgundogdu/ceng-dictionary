<?php
    $msg_username = $_GET['user'];
    $msg_user = $dbActions->getUserWithName($msg_username);
    $msg_user_info = $msg_user->fetch_assoc();
    $msg_uid = $msg_user_info['u_id'];   
    $all_messages = $dbActions->getMessages($session_uid, $msg_uid);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $receiver_username = $_GET['user'];
        $text = $_POST['send-msg'];
        $result = $dbActions->getUserWithName($receiver_username);

        $result_info = $result->fetch_assoc();
        $receiver_id = $result_info['u_id'];
        $dbActions->addMessage($text, $session_uid, $receiver_id);
        header("location: index.php");               
    }


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
                    <span class="time time-right"> ' . $msg_date . '</span>
                    </div>
                    ';
                }

                else {
                    echo '
                    <div class="message">
                    <p class="message-text">'. $msg . '</p>
                    <span class="time time-left">' . $msg_date . '</span>
                    </div> ';
                }
            }
        ?>
    </div>
    <form class="send-message" method= "POST">
        <textarea id="send-msg" name="send-msg" rows="4" cols="58"  required></textarea><br/>
        <button type="submit" value="Submit">gönder</button>
    </form>
</div>