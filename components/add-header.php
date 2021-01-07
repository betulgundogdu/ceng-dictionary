<?php
session_start();

$header_title = $entry_text = $header = $first_entry = $header_err = $entry_err = '';
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo '
        <form class="add-header" action="?page=entry" method="POST"> 
            <p class="title">yeni bir başlık aç     </p><br/>
            <label for="new-header">başlık:</label>
            <input type="text" id="header" name="header" value="' . $header_title . '" required /><br/>
            <label for="new-header">entry:</label>
            <textarea id="header" name="f-entry" rows="10" cols="30" value="'. $entry_text .'" required></textarea><br/>
            <button type="submit">gönder</button>
        </form> 
    '; 
} 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $new_header = trim($_POST["header"]);
    $first_entry = trim($_POST["f-entry"]);

    if(empty($new_header)){
        $header_err = "Please enter a header";
    }

    if(empty($first_entry)){
        $entry_err = "You should enter the first entry about your header.";
    }

    if(!empty($new_header) && !empty($first_entry)){
        include('./connect.php');
        $stmt = $mysqli -> prepare("INSERT INTO ");
    }


}

?>
