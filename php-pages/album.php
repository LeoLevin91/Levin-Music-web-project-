<?php include("header.php")?>


        <?php
        if(isset($_GET['id'])){
            $albumId = $_GET['id'];
        } else {
            header("Location: index.php");
        }

        $album = new Album($con, $albumId);


        $artist = $album -> getArtist();

        echo $artist->getName() . "<br>";
        echo $album->getTitle();
        ?>


<?php include("footer.php")?>