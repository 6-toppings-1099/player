<?php
  $uri = explode("/", urldecode($_SERVER["REQUEST_URI"]));

  $artist_name = $uri[count($uri) - 2];

  $album_name = end($uri);

  $dirs = array_diff(scandir("/mnt/music/$artist_name/$album_name"), array(".", "..", "cover.jpg"));

  foreach ($dirs as $dir) {
    $split_dir = explode(' - ', $dir, 2);

    $track_number = $split_dir[0];

    $title = str_replace('.mp3', '', $split_dir[1]);

    echo "<li class='song' id='$dir' data-path='/music/$artist_name/$album_name/$dir' data-title='$title' data-artist='$artist_name' data-track-number=''>
            $title
          </li>";
  }
?>