<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/songs.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Archive</title>
</head>
<body>
  <ul class="songs">
    <?php
      include "php/songs.php";
    ?>
  </ul>
</body>
<script>
  $(".song").click(function() {
    let gteq = $('ul li');

    let list_songs = $.map(gteq, function(i) {
      return {
        title: $(i).data("title"),
        path: $(i).data("path"),
        artist: $(i).data("artist"),
      };
    });

    console.log(list_songs);

    window.top.postMessage({type: "play", songs: list_songs, index: $(this).index()}, "*");
  })
</script>
</html>