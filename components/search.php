<?php
$flag = false;
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $flag = true;
    $searched = $_POST["searched"];

    $dbActions = new DBActions($mysqli); 
    $result_user = $dbActions->getUserWithName($searched);
    $result_header = $dbActions->getHeaderWithTitle($searched);
}
?>
<div class="search-area">
    <div class="title"> 
        <span>sitede ara</span>
    </div>
    <form class="search-form" method="POST">
        <input type="input" placeholder="başlık veya kullanıcı ara" name="searched" required/>
        <button type="submit">ara</button>
        <!-- <span class="psw">unuttun mu <a href="#">şifreni?</a></span> -->
    </form>
    <div class="result">
        <?php
            if($result_user->num_rows > 0){
                $user = $result_user->fetch_assoc();
                $u_id = $user['u_id'];   
                echo '<a href="?page=profil&user='. $user['username'] .'"> ' .  $user['username'] . '</a><span> (kullanıcı)</span><br/>';                
                $flag=false;
            }

            if($result_header->num_rows > 0){
                $header = $result_header->fetch_assoc();
                $h_id = $header['h_id'];   
                $c_id = $header['c_id'];
                $h_title = $header['title'];
                $flag=false;
                echo '<a href="?page=entry&category='. $c_id .'&baslik=' . $h_id . '"> ' . $h_title . '</a><span> (başlık)</span><br/>';                
            }

            if($flag){
                echo '<span>Böyle bişey yok.</span>';
            }
        ?>
    </div>
</div>