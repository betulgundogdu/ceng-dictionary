<?php
$username_err = $entered_username  = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $entered_username = $_POST['receiver'];
        $text = $_POST['send-msg'];
        $result = $dbActions->getUserWithName($entered_username);
        if(!$result){
            $username_err = "No account found with that username.";
        } else {
            $result_info = $result->fetch_assoc();
            $receiver_id = $result_info['u_id'];
            $dbActions->addMessage($text, $session_uid, $receiver_id);
            header("location: index.php");
        }
    }
?>


<div class="messaging-wrapper">
    <span>mesaj yolla</span>
    <form class="send-msg form" method="POST">
        <label> kime:</label><br/>
        <input type="text" name="receiver" placeholder="kullanıcı adı"/><br/>
        <span><?php echo $username_err ?></span> <br/>
        <label> mesaj:</label><br/>
        <textarea id="send-msg" name="send-msg" rows="15" cols="50"  required></textarea><br/>
        <button type="submit" value="Submit">gönder</button>
    </form>
 
</div>