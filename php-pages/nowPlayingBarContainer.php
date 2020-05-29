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
        var newPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(newPlaylist[0], newPlaylist, false);
        updateVolumeProgressBar(audioElement.audio);

        $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function (e) {
            e.preventDefault();
        });

        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if(mouseDown == true) {
                //Set time of song, depending on position of mouse
                timeFromOffset(e, this);
            }
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });


        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e) {
            if(mouseDown == true) {
                var persentage = e.offsetX / $(this).width();
                if(persentage >= 0 && persentage <= 1){
                    audioElement.audio.volume = persentage;
                }

            }
        });

        $(".volumeBar .progressBar").mouseup(function(e) {
            var persentage = e.offsetX / $(this).width();
            audioElement.audio.volume = persentage;
        });

        $(document).mouseup(function() {
            mouseDown = false;
        });


    });

    function timeFromOffset(mouse, progressBar) {
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }
    
    function prevSong() {
        if(audioElement.audio.currentTime >= 3 || currentIndex == 0){
            audioElement.setTime(0);
        } else {
            currentIndex = currentIndex - 1;
            setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
        }
    }
    
    function nextSong() {
        if(repeat == true){
            audioElement.setTime(0);
            playSong();
            return;
        }

        if(currentIndex == currentPlaylist.length - 1){
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        var trackToPlay = shuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, true);
    }

    function setRepeat() {
        repeat = !repeat;
        var imageName = repeat ? "repeat-active.png" : "repeat.png";
        $(".controlButton.repeat img").attr("src", "../assets/images/icons/" + imageName);
    }

    function setMute() {
        audioElement.audio.muted = !audioElement.audio.muted;
        var imageMute = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
        $(".controlButton.volume img").attr("src", "../assets/images/icons/" + imageMute);
    }

    function setShuffle() {
        shuffle = !shuffle;
        var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
        $(".controlButton.shuffle img").attr("src", "../assets/images/icons/" + imageName);

        if(shuffle == true) {
            //Randomize playlist
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
        else {
            //shuffle has been deactivated
            //go back to regular playlist
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }

    }

    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
    }


    function setTrack(trackId, newPlayList, play) {

        if(newPlayList != currentPlaylist) {
            currentPlaylist = newPlayList;
            shufflePlaylist = currentPlaylist.slice();
            shuffleArray(shufflePlaylist);
        }

        if(shuffle == true) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        }
        else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();
        // Ajax Call
        $.post("../php-scripts/handler/ajax/getSongJson.php", {songId: trackId}, function (data) {
            
            var track = JSON.parse(data);

            //console.log(track);

            $(".trackName span").text(track.title);

            $.post("../php-scripts/handler/ajax/getArtistJson.php", {artistId: track.artist}, function (data) {
                var artist = JSON.parse(data);
                //console.log(artist)
                $(".artistName span").text(artist.name);
            });

            $.post("../php-scripts/handler/ajax/getArtworkJson.php", {albumId: track.album}, function (data) {
                var artworkPath = JSON.parse(data);
                //console.log(artworkPath);
                $(".albumLink img").attr('src', artworkPath.artworkPath);
            })

            audioElement.setTrack(track);
            if(play == true){
                playSong();
            }
        });


    }
    
    function playSong() {

        if(audioElement.audio.currentTime == 0){
            $.post("../php-scripts/handler/ajax/updatePlays.php", {songId: audioElement.currentlyPlaying.id});
        }

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
                    <img src="" alt="album" class="albumArtwork">
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
                    <button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle();">
                        <img src="../assets/images/icons/shuffle.png" alt="shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous button" onclick="prevSong();">
                        <img src="../assets/images/icons/previous.png" alt="previous">
                    </button>

                    <button class="controlButton play" title="Play button" onclick="playSong();">
                        <img src="../assets/images/icons/play.png" alt="play" >
                    </button>

                    <button class="controlButton pause" title="Pause button" style="display: none" onclick="pauseSong();">
                        <img src="../assets/images/icons/pause.png" alt="pause" >
                    </button>

                    <button class="controlButton next" title="Next button" onclick="nextSong();">
                        <img src="../assets/images/icons/next.png" alt="next" >
                    </button>

                    <button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
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
                <button class="controlButton volume" title="Volume button" onclick="setMute();">
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