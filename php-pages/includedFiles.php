<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/User.php");
    include("../php-scripts/classes/Artist.php");
    include("../php-scripts/classes/Album.php");
    include("../php-scripts/classes/Song.php");
    include("../php-scripts/classes/Playlist.php");

    if(isset($_GET['userLoggedIn'])) {
        $userLoggedIn = new User($con, $_GET['userLoggedIn']);
    }
    else {
        echo "Username variable was not passed into page. Check the openPage JS function";
        exit();
    }
}
else {
    include("header.php");
    include("footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
    exit();
}

?>