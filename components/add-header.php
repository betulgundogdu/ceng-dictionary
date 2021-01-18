<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $u_id = $_SESSION["id"];

    $sql = "SELECT c_id, title FROM Category";
    $result = $mysqli -> query($sql);

    $selected_category =$header_title = $entry_text = '';
    $category_err =$header_err = $entry_err = '';

    echo '
        <form class="add-header" method="POST"> 
            <p class="title">yeni bir başlık aç     </p><br/>
            <label for="header-title">başlık:</label>
            <input type="text" id="header-title" name="header-title" required /><br/>
            
            <label for="category-dropdown">kategori:</label>
            <select class="dropdown" name="selected-category" id="category-dropdown">';

    while($row = $result -> fetch_assoc()) {
        echo '<option class="tags" value="' . $row['c_id'] . '">' .  $row['title'] . '</option>';
    }

    echo '</select><br/>
            <label for="entry-text">entry:</label>
            <textarea id="entry-form" name="entry-text" rows="10" cols="30"  required></textarea><br/>
            <button type="submit" value="Submit">gönder</button>
        </form> 
    '; 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $dbActions = new DBActions($mysqli);
        $header_title = $_POST["header-title"];
        $entry_text = $_POST["entry-text"];
        $selected_category =(int)$_POST["selected-category"];
        $dbActions->addHeader($header_title, $selected_category);
        
        $header_info = $dbActions->getHeaderWithTitle($header_title);
        $h_id = $header_info['h_id'];
        $dbActions->addEntry($h_id, $entry_text, $u_id);     
    }
    $mysqli->close();
} 


?>
