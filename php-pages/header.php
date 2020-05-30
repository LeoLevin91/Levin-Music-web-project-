<?php
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/Artist.php");
    include("../php-scripts/classes/Album.php");
    include("../php-scripts/classes/Song.php");
    //session_destroy();

    if(isset($_SESSION['userLoggedIn'])){
        $userLoggedIn = $_SESSION['userLoggedIn'];
        echo "<script>userLoggedIn = '$userLoggedIn';</script>";
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
    <link href="../css/album-page-style.css" rel="stylesheet" type="text/css">
    <link href="../css/artist-page-style.css" rel="stylesheet"  type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <title>Your Page</title>
</head>
<body>


    <div class="mainContainer">

        <div id="topContainer">
            <?php include("navBarContainer.php");?>
        <div id="mainViewContainer">
            <div id="mainContent">

        