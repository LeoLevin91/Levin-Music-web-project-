<div id="mainViewContainer">
    <div id="mainContent">
        <h1 class="pageHeadingBig">You Might Also Like</h1>

        <div class="gridVievContainer">
            <?php
                // Выводим названия альбомов и их обложки
                $albumQuery = mysqli_query($con, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");               

                while($row = mysqli_fetch_array($albumQuery)){
                    echo "<div class='gridViewItem'>
                        <a href='album.php?id=". $row['id'] ."'>
                            <img src='" . $row['artworkPath'] . "'>
                            <div class='gridViewInfo'>"
                                . $row['title'] .
                            "</div> 
                        </a>
                    </div>";
                }
            
            
            ?>

        </div>
    </div>     
</div>