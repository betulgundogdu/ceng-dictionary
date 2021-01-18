<?php
// Initialize the session
session_start();
global $mysqli;

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Define variables and initialize with empty values
$entered_username = $entered_password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $entered_username = trim($_POST["username"]);
    $entered_password = trim($_POST["password"]);

    $dbActions = new DBActions($mysqli); 
    $result = $dbActions->getUser($entered_username);
    $u_id = $result[0]['u_id'];                    
    $username = $result[0]['username'];
    $password = $result[0]['password'];
    $count = count($result);

    if($count == 1){
        if(password_verify($entered_password, $password)){
            // Password is correct, so start a new session
            session_start();

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $u_id;
            $_SESSION["username"] = $username;                            
                            
            // Redirect user to welcome page
            header("location: index.php ");
        } else{
            // Display an error message if password is not valid
            $password_err = "The password you entered was not valid.";
        }                
    } else{
        // Display an error message if username doesn't exist
        $username_err = "No account found with that username.";
    }

    $mysqli->close();
}
?>

<form class="user-form container" id="login"  method="POST">
    <div class="title"> 
        <span>giriş</span>
    </div>
    <label for="username"><b>username</b></label>
    <input type="text" placeholder="Enter Username" name="username" value="<?php echo $entered_username; ?>" required>
    <span class="help-block"><?php echo $username_err; ?></span>

    <label for="password"><b>şifre</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <span class="help-block"><?php echo $password_err; ?></span>

    <!-- <label>
        <input type="checkbox" checked="checked" name="remember"> hatırla beni
    </label>                      -->
    <button type="submit">giriş</button>
    <!-- <span class="psw">unuttun mu <a href="#">şifreni?</a></span> -->
  </div>
</form>