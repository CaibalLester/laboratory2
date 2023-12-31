<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script> var writePath = "C:\laragon\www\laboratoryact2\writable\uploads"; </script>
    <style>
    body {
         font-family: Arial, sans-serif;
         text-align: center;
         background-color: #f5f5f5;
         padding: 20px;
     }
     h1 {
         color: #333;
     }
     #player-container {
         max-width: 400px;
         margin: 0 auto;
         padding: 20px;
         background-color: #fff;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
     }
     audio {
         width: 100%;
     }
     #playlist {
         list-style: none;
         padding: 0;
     }
     #playlist li {
         cursor: pointer;
         padding: 10px;
         background-color: #eee;
         margin: 5px 0;
         transition: background-color 0.2s ease-in-out;
     }
     #playlist li:hover {
         background-color: #ddd;
     }
     #playlist li.active {
         background-color: #007bff;
         color: #fff;
     }
     * {
          box-sizing: border-box;
        }

    #myPlaylist {
      background-image: url('/css/searchicon.png');
      background-position: 10px 12px;
      background-repeat: no-repeat;
      width: 25%;
      border-radius: 15px;
      font-size: 16px;
      padding: 12px 20px 12px 40px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }
    #myPlaylist li a {
      border: 1px solid #ddd;
      margin-top: -1px; /* Prevent double borders */
      background-color: #f6f6f6;
      padding: 12px;
      text-decoration: none;
      border-radius: 15px;
      font-size: 18px;
      color: black;
      display: block
    }
    #myPlaylist li a:hover:not(.header) {
      background-color: #eee;
      border-radius: 10px;
    }
    </style>
</head>
<body>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
          <br>
              <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Your playlist</a>
              <br>
        </div>
            <div class="modal-footer">
            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Close</a>
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlaylist">Create New</a>
            </div>
      </div>
    </div>
  </div>


  <form action="/save" method="post">
  <div class="modal fade" id="createPlaylist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter Music Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" >
                <label>Name :</label>
                    <input type="text" name="name" value="<?php if (isset($pro['name'])) {echo $pro['name'];}?>" placeholder="Name">
                    <br><br>
                <label>Audio :</label>
                    <input type="file" name="audio" value="<?php if (isset($pro['audio'])) {echo $pro['audio'];}?>" placeholder="Audio" accept="audio/*" required >
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="save">
        </div> 
      </div>
    </div>
  </div>
  </form>

  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Select from playlist</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <!-- Modal body -->
          <div class="modal-body">
          <form action="/" method="post">
            <!-- <p id="modalData"></p> -->
            <input type="hidden" id="musicID" name="musicID">
                        <ul id="playlist">
                <?php foreach ($music as $index => $pr): ?>
                        <li data-src="<?=base_url(); ?>/music/<?= $pr['audio']; ?>.mp3"><?= $pr['audio']; ?>
                          <a href="/addtoplaylist" class="hover-effect">
                          </a>
                        </li>
                  <?php endforeach; ?>
                </ul>
            </form>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>

      <form action="/" method="get">
    <input type="text" id="myPlaylist" onkeyup="myFunction()" placeholder="Search song..." title="Type in a song">
      <h1>Music Player</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
          My Playlist
        </button>
            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlaylist">Add Music</a>
            <audio id="audio" controls autoplay></audio>
                <ul id="playlist">
            <?php foreach ($music as $index => $pr): ?>
                <li data-src="<?=base_url(); ?>/music/<?= $pr['audio']; ?>.mp3"><?= $pr['audio']; ?>&nbsp&nbsp&nbsp&nbsp&nbsp
                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPlaylist">+</a>
                <a href="/delete/<?= $pr['id'] ?>" type="button" class="btn btn-danger">Delete</a>
                 
                  <a href="/addtoplaylist" class="hover-effect">
                  
                  </a>  </li>
          <?php endforeach; ?>
        </ul>
      </form>

    <script>
          $(document).ready(function () {
          const modal = $("#myModal");
          const modalData = $("#modalData");
          const musicID = $("#musicID");
          function openModalWithData(dataId) {
            modalData.text("Data ID: " + dataId);
            musicID.val(dataId);
            modal.css("display", "block");
          }
        modal.click(function (event) {
            if (event.target === modal[0] || $(event.target).hasClass("close")) {
              modal.css("display", "none");
            }
          });
        });
    </script>

    <script>
        const audio = document.getElementById('audio');
        const playlist = document.getElementById('playlist');
        const playlistItems = playlist.querySelectorAll('li');

        let currentTrack = 0;

        function playTrack(trackIndex) {
            if (trackIndex >= 0 && trackIndex < playlistItems.length) {
                const track = playlistItems[trackIndex];
                const trackSrc = track.getAttribute('data-src');
                audio.src = trackSrc;
                audio.play();
                currentTrack = trackIndex;
            }
        }

        function nextTrack() {
            currentTrack = (currentTrack + 1) % playlistItems.length;
            playTrack(currentTrack);
        }

        function previousTrack() {
            currentTrack = (currentTrack - 1 + playlistItems.length) % playlistItems.length;
            playTrack(currentTrack);
        }

        playlistItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                playTrack(index);
            });
        });

        audio.addEventListener('ended', () => {
            nextTrack();
        });

        playTrack(currentTrack);

        function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myPlaylist");
    filter = input.value.toUpperCase();
    ul = document.getElementById("playlist");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
    </script>
    <script>
        console.log("writePath:", writePath);
    </script>
</body>
</html>
