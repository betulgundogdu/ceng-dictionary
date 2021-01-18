<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__.'/connect.php');
require_once(__DIR__.'/DBActions.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title> ceng dictionary </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
</head>
<body>
    <div class="main">
        <div class="content">
            <?php 
                require('components/left-section.php');
            ?>
            <div class="right container">
                <?php 
                    $page = $_GET['page'];


                    if($page == ""){
                        $page = 'popular';
                    }
                    $path = 'components/' . $page . '.php';
                    if((require $path) == FALSE){
                        require('components/404.php');
                    }
                    
                ?>
            </div>
        </div>
    </div>
</body>
</html>