<!DOCTYPE html>
<?php
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/Account.php");
    include("../php-scripts/classes/Constans.php");
    $account = new Account($con);
    include("../php-scripts/handler/login-handler.php");

    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../css/login-page-style.css" rel="stylesheet" type="text/css">
    <title>Log In - Levin Music</title>
</head>
<body>
    <header>
        <div class="logoLoginPage">
            <a href="start-page.php"><img src="../img/Logo-1-green.png" alt="Logo"></a>
        </div>
    </header>



    <div id='inputContainer'>
        <form id="loginForm" action="login-page.php" method="POST">
            <h4>To continue, log in to Levin Music.</h4>
            <div class='rForm loginUserNameDiv'>
                <?php echo $account->getError(Constans::$loginFailed)?>
                <label for="loginUserName">Username</label>
                <input type="text" id='loginUserName' name='loginUserName' value="<?php getInputValue('loginUserName')?>" placeholder='Your name' >
            </div>
            <div class='rForm passwordUserDiv'>
                <label for="passwordUser">Password</label>
                <input type="password" id='passwordUser' name='passwordUser' placeholder='Your password'>
            </div>
            <button type="submit" name="loginButton">LOG IN</button>
        </form>
        <p>No account? <a href="register-page.php">Sign up</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>