<?php
    include("../php-scripts/configurate/config.php");
    
    //session_destroy();

    if(isset($_SESSION['userLoggedIn'])){
        $userLoggedIn = $_SESSION['userLoggedIn'];
    } else {
        header("Location: register-page.php");
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link href="../css/index-page-style.css" rel="stylesheet" type="text/css">
    <title>Your Page</title>
</head>
<body>

    <div class="mainContainer">

        <div id="topContainer">
            <?php include("navBarContainer.php");?>

            <?php include("mainViewContainer.php")?>
        </div>
        <?php include("nowPlayingBarContainer.php");?>

    </div>

</body>
</html>