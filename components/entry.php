<?php
    include('./connect.php');
    $category = $_GET['category'];
    if($category == ""){
        $category = 1;
    }
    $date = date('Y-m-d');
    $u_id = $_SESSION["id"];
    $h_id = $_GET['baslik'];
    $h_title = '';
    $stmt = $mysqli->prepare("SELECT h_id, title FROM Header WHERE c_id = ?");
    $stmt->bind_param("s", $category);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if (count($result) > 0) {
            while($row = $result -> fetch_assoc()) {
                $h_id = $row['h_id'];
                $h_title = $row['title'];
            }
        } else {    
            echo "0 results";
        }  
        $stmt->close();    
    } else {
        echo "Error: " . $stmt->error;
    }
?>

<div class="title"> 
    <div><?php echo $h_title ?></div>
    <a class="edit"> düzenle </a>|<a class="edit"> sil</a> <!-- sadece mod/admin-->
</div>

<div class="entries">
    <div class="entry">
        <p class="entry-content"> hello world</p>
        <div class="right detail">
            <span class="username">username</span><span class="time"> | 06.03.23 23:21</span>
            <span>| <a class="edit">delete </a></span> <!--mod ve admin-->
        </div>
    </div>
<?php
    $stmt = $mysqli->prepare("SELECT text, created_date, u_id FROM Entry WHERE h_id = ?");
    $stmt->bind_param("s", $h_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if (count($result) > 0) {
            while($row = $result -> fetch_assoc()) {
                echo(" 
                    <div class='entry'>
                        <p class='entry-content'>" . $row['text'] . "</p>
                        <div class='right detail'>
                            <span class='username'>" . $row['u_id']. "</span>
                            <span class='time'> | " . $row['created_date'] . "</span>
                            <span> | <a class='edit'>delete </a></span> <!--mod ve admin-->
                        </div>
                    </div>                     
                ");
            }
        } else {    
            echo "0 results";
        }  
        $stmt->close();    
    } else {
        echo "Error: " . $stmt->error;
    }

    //Form for adding entry 
    session_start();
    if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true){
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
                $stmt = $mysqli->prepare("INSERT INTO Entry (h_id, text, created_date, u_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $h_id , $entry, $date, $u_id);
                if ($stmt->execute()) {
                    echo "New record created successfully";
                    header("location: index.php?page=entry&baslik=". $h_id);
                } else {
                    echo "Error: " . $stmt->error;
                }       
                $stmt->close();
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