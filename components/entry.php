<?php
    global $mysqli;
    $h_id = $_GET['baslik'];
    $category = $_GET['category'];
    var_dump($h_id);
    var_dump($category);
    $dbActions = new DBActions($mysqli);
    $header = $dbActions->getHeaderWithId($h_id);
    $h_title = $header['title'];
?>

<div class="title"> 
    <div><?php echo $h_title ?></div>
    <a class="edit"> düzenle </a>|<a class="edit"> sil</a> <!-- sadece mod/admin-->
</div>

<div class="entries">
<?php
    $entries = $dbActions->getAllEntries($h_id);
    if (count($entries) > 0) {
        while($row = $entries->fetch_assoc()) {
            echo(" 
                <div class='entry'>
                    <p class='entry-content'>" . $row['text'] . "</p>
                    <div class='right detail'>
                        <span class='username'>" . $row['u_id'] . "</span>
                        <span class='time'> | " . $row['created_date'] . "</span>
                        <span> | <a class='edit'>delete </a></span> <!--mod ve admin-->
                    </div>
                </div>                     
            ");
        }
    } else {    
        echo "No entry";
    }  

    //Form for adding entry 
    session_start();
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
    $mysqli->close();               
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