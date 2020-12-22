<!DOCTYPE html>
<html>
<head>
    <title> ceng dictionary </title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main">
        <div class="settings">
            <a href="login.php" class="item"> giriş</a>
            <a href="signup.php" class="item"> kayıt ol</a>
        </div>
        <div class="content">
            <?php 
                include('components/left-section.php');
            ?>
            <div class="right container">
                <?php 
                    $page = 'entry';
                    $path = 'components/' . $page . '.php';
                    include $path;
                ?>
            </div>
        </div>
    </div>
</body>
</html>