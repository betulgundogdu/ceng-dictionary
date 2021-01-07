<!DOCTYPE html>
<html>
<head>
    <title> ceng dictionary </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main">
        <div class="content">
            <?php 
                include('components/left-section.php');
            ?>
            <div class="right container">
                <?php 
                    $page = $_GET['page'];
                    if($page == ""){
                        $page = 'popular';
                    }
                    $path = 'components/' . $page . '.php';
                    if((include $path) == FALSE){
                        include('components/404.php');
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>