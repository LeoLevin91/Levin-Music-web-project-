<?php

    // Random playing
    $songQuery = mysqli_query($con, "SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();

    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    // I need convert PHP array in JS array for playing music
    $jsonArray = json_encode($resultArray);
?>
<script>
    $(document).ready(function () {
        currentPlaylist = <?php echo $jsonArray;?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);
    });

    function setTrack(trackId, newPlayList, play) {

        // Ajax Call
        $.post("../php-scripts/handler/ajax/getSongJson.php", {songId: trackId}, function (data) {
            //console.log(data);
            var track = JSON.parse(data);

            console.log(track);

            $(".trackName span").text(track.title);

            $.post("../php-scripts/handler/ajax/getArtistJson.php", {artistId: track.artist}, function (data) {
                var artist = JSON.parse(data);
                console.log(artist)
                $(".artistName span").text(artist.name);
            });

            $.post("../php-scripts/handler/ajax/getArtworkJson.php", {albumId: track.album}, function (data) {
                var artworkPath = JSON.parse(data);
                console.log(artworkPath);
                $(".albumLink img").attr('src', artworkPath.artworkPath);
            })


            audioElement.setTrack(track.path);
            audioElement.play();
        });

        if(play == true){
            audioElement.play();
        }
    }
    
    function playSong() {
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }

</script>



<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content">
                <span class="albumLink">
                    <img src="https://im0-tub-ru.yandex.net/i?id=feb5333675e23aa53c8b3593883af0b9&n=13" alt="album" class="albumArtwork">
                </span>

                <div class="trackInfo">
                    <span class="trackName">
                        <span></span>
                    </span>
                    <span class="artistName">
                        <span></span>
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
                        <img src="../assets/images/icons/play.png" alt="play" onclick="playSong();">
                    </button>

                    <button class="controlButton pause" title="Pause button" style="display: none">
                        <img src="../assets/images/icons/pause.png" alt="pause" onclick="pauseSong();">
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