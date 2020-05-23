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
            <div id="navBarContainer">
                <nav class="navBar">
                    <a href="index.php" class="logo">
                        <img src="../img/Logo-1.png" alt="Red Logo">
                    </a>

                    <div class="group">
                        <div class="navItem">
                            <a href="search.php" class="navItemLink">Search
                                <img src="../assets/images/icons/search.png" alt="Search" class="searchImage">
                            </a>
                        </div>
                    </div>

                    <div class="group">
                        <div class="navItemBlock1">
                            <a href="browse.php" class="navItemLink">Browse</a>
                        </div>
                        <div class="navItemBlock1">
                            <a href="yourMusic.php" class="navItemLink">Your Music</a>
                        </div>
                        <div class="navItemBlock1">
                            <a href="profile.php" class="navItemLink">LeoLevin91</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    


        <div id="nowPlayingBarContainer">
            <div id="nowPlayingBar">
                <div id="nowPlayingLeft">
                    <div class="content">
                        <span class="albumLink">
                            <img src="https://im0-tub-ru.yandex.net/i?id=feb5333675e23aa53c8b3593883af0b9&n=13" alt="album" class="albumArtwork">
                        </span>

                        <div class="trackInfo">
                            <span class="trackName">
                                <span>Bad Gay</span>
                            </span>

                            <span class="artistName">
                                <span>Billy Elish</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingCenter">
                    <div class="content playerControls">
                        <div class="buttons">
                            <button class="controlButton shuffle" title="Shuffle button">
                                <img src="../assets/images/icons/shuffle.png" alt="shuffle">
                            </button>

                            <button class="controlButton previous" title="Previous button">
                                <img src="../assets/images/icons/previous.png" alt="previous">
                            </button>

                            <button class="controlButton play" title="Play button">
                                <img src="../assets/images/icons/play.png" alt="play">
                            </button>

                            <button class="controlButton pause" title="Pause button" style="display: none">
                                <img src="../assets/images/icons/pause.png" alt="pause">
                            </button>

                            <button class="controlButton next" title="Next button">
                                <img src="../assets/images/icons/next.png" alt="next">
                            </button>

                            <button class="controlButton repeat" title="Repeat button">
                                <img src="../assets/images/icons/repeat.png" alt="repeat">
                            </button>
                        </div>

                        <div class="playbackBar">
                            <span class="progressTime current">0.00</span>
                            <div class="progressBar">
                                <div class="progressBarBg">
                                    <div class="progress"></div>
                                </div>
                            </div>
                            <span class="progressTime remaining">0.00</span>
                        </div>
                    </div>
                </div>
                <div id="nowPlayingRight">
                    <div class="volumeBar">
                        <button class="controlButton volume" title="Volume button">
                            <img src="../assets/images/icons/volume.png" alt="Volume">
                        </button>

                        <div class="progressBar">
                                <div class="progressBarBg">
                                    <div class="progress"></div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </div>

</body>
</html>