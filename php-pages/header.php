<?php
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/User.php");
    include("../php-scripts/classes/Artist.php");
    include("../php-scripts/classes/Album.php");
    include("../php-scripts/classes/Song.php");
    include("../php-scripts/classes/Playlist.php");
    //session_destroy();

    if(isset($_SESSION['userLoggedIn'])){
        $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
        $username = $userLoggedIn->getUsername();
        echo "<script>userLoggedIn = '$username';</script>";
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
    <link href="../css/search-page-style.css" rel="stylesheet"  type="text/css">
    <link href="../css/yourMusic-page.css" rel="stylesheet"  type="text/css">
    <link href="../css/playlist-page-style.css" rel="stylesheet"  type="text/css">
    <link href="../css/settings-page-style.css" rel="stylesheet"  type="text/css">
    <link href="../css/updateDetails-page-style.css" rel="stylesheet"  type="text/css">
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

        