<!DOCTYPE html>
<?php
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/Account.php");
    include("../php-scripts/classes/Constans.php");
    $account = new Account($con);

    
    include("../php-scripts/handler/register-handler.php");

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
    <link href="../css/register-page-style.css" rel="stylesheet" type="text/css">
    <title>Sign up - Levin Music</title>
</head>
<body>
    <header>
        <div class="logoRegisterPage">
            <a href="start-page.php"><img src="../img/Logo-1-green.png" alt="Logo"></a>
        </div>
    
    </header>

    <div id='inputContainer'>
            <form id="registerForm" action="register-page.php" method="POST">
                <h4>Create your free account</h4>
                <div class='rForm registerLoginNameDiv'>
                    <?php echo $account->getError(Constans::$usernameBetween);?>
                    <?php echo $account->getError(Constans::$usernameTaken);?>
                    <label for="userName">Username</label>
                    <input type="text" id='userName' name='userName' placeholder='Your login' value="<?php getInputValue('userName')?>">
                </div>

                <div class='rForm registerFirstNameDiv'>
                    <?php echo $account->getError(Constans::$firstnameBetween);?>
                    <label for="firstName">First name</label>
                    <input type="text" id='firstName' name='firstName' placeholder='Your First name' value="<?php getInputValue('firstName')?>">
                </div>

                <div class='rForm registerLastNameDiv'>
                    <?php echo $account->getError(Constans::$lastnameBetween);?>
                    <label for="lastName">Last name</label>
                    <input type="text" id='lastName' name='lastName' placeholder='Your Last name' value="<?php getInputValue('lastName')?>">
                </div>

                <div class='rForm registerEmailDiv'>
                    <?php echo $account->getError(Constans::$emailDontMuch);?>
                    <?php echo $account->getError(Constans::$emailDontCorrect);?>
                    <?php echo $account->getError(Constans::$emailTaken);?>
                    <label for="email">Email</label>
                    <input type="text" id='email' name='email' placeholder='Your Email' value="<?php getInputValue('email')?>">
                </div>

                <div class='rForm registerConfirmEmailDiv'>
                    <?php echo $account->getError(Constans::$emailDontMuch);?>
                    <?php echo $account->getError(Constans::$emailDontCorrect);?>
                    <label for="confEmail">Confirm Email</label>
                    <input type="text" id='confEmail' name='confEmail' placeholder='Confirm Email' value="<?php getInputValue('confEmail')?>">
                </div>

                <div class='rForm registerPasswordUserDiv'>
                    <?php echo $account->getError(Constans::$passwordsDoNotMuch);?>
                    <?php echo $account->getError(Constans::$passwordsContain);?>
                    <?php echo $account->getError(Constans::$passwordsBetween);?>
                    <label for="password">Password</label>
                    <input type="password" id='password' name='password' placeholder='Your password'>
                </div>

                <div class='rForm registerConfirmPasswordUserDiv'>
                    <?php echo $account->getError("Your passwords don't match");?>
                    <?php echo $account->getError("Your password can only contain numbers and letters");?>
                    <?php echo $account->getError("Your password must be between 7 and 30 characters");?>
                    <label for="password2">Password</label>
                    <input type="password" id='password2' name='password2' placeholder='Your password'>
                </div>
                <button type="submit" name="registerButton" id='registerButton'>SIGN UP</button>
            </form>
            <p>Already have an account? <a href="login-page.php">Log in</a></p>
    </div>
        


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>