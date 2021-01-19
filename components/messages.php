<div class="messages-wrapper">
 <div class="messages-header">   
    <p class="title">Mesajlar</p>
    <a href="?page=new-message">yeni mesaj</a>
</div>
<div class="messages">
    <?php
        $result = $dbActions->getUsersOnMessage($session_uid);
        while($row = $result -> fetch_assoc()){
            $receiver_id = $row['receiver_id'];
            $receiver = $dbActions->getUserWithId($receiver_id);
            $receiver_info = $receiver->fetch_assoc();
            $receiver_username = $receiver_info['username'];
            // $msg = $row['text'];
            echo '<div class="item">
            <a href="?page=message&user=' . $receiver_username . ' "> ' . $receiver_username . ' </a>
        </div> ';
        }
    ?>

    
    
</div>
<div class="page-count">
    <select>
        <option>1</option>
        <option>2</option>
        <option>3</option>
    </select> / 
    <button class="last-page">3</button>
    <button class="next-page">></button>
</div>
</div>