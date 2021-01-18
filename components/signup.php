<?php 
    $username_err = $email_err = $password_err = '';
    $username = $email = $hash_password = '';
    $dbActions = new DBActions($mysqli); 

    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate username
        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter a username.";
        } else{
            $username_param = trim($_POST["username"]);
            $result = $dbActions->getUser($username_param);
            $count = count($result);
            if($count < 1){
                $username = $username_param;
            }
            else {
                $username_err = "This username is already taken.";
            }
        }

        // Validate email
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter a email.";
        } else{
            $email_param = trim($_POST["email"]);
            if( $dbActions->isValidEmail($email_param)){
                $email = $email_param;
            }
            else {
                $email_err = "This email is already taken.";
            }
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have at least 6 characters.";
        } else{
            $param_password = trim($_POST["password"]);
            $hash_password = password_hash($param_password, PASSWORD_DEFAULT);
        }
        
        // Check input errors before inserting in database
        if(empty($username_err) && empty($password_err) && empty($email_err)){
            if($dbActions->addUser($username, $email, $hash_password)){
                header("location: index.php");
            }
            else {
                echo("Something is wrong.");
            }
        }
        $mysqli->close();
    }
?>

<form class="user-form container" id="signup" method="POST">
    <div class="title"> 
        <span>kayıt</span>
    </div>
    <label for="username"><b>kullanıcı adı</b></label>
    <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username; ?>" required>
    <span class="help-block"><?php echo $username_err; ?></span>

    <label for="email"><b>e-mail</b></label>
    <input type="text" placeholder="Enter Email" name="email" value="<?php echo $email; ?>" required>
    <span class="help-block"><?php echo $email_err; ?></span>

    <label for="password"><b>şifre</b></label>
    <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password; ?>" required>
    <span class="help-block"><?php echo $password_err; ?></span>
    <!-- <label>
        <input type="checkbox" required name="sozlesme"><a href="#">sözleşme</a>yi okudum, kabul ettim.
    </label>                      -->
  <button type="submit" value="Submit">kaydol</button>
</form>
