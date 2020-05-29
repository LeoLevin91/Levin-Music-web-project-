<?php

if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    include("../php-scripts/configurate/config.php");
    include("../php-scripts/classes/Artist.php");
    include("../php-scripts/classes/Album.php");
    include("../php-scripts/classes/Song.php");
}
else {
    include("header.php");
    include("footer.php");

    $url = $_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
    exit();
}

?>