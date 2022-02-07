<?php
  $uri = urldecode($_SERVER["REQUEST_URI"]);

  $artist_name = end(explode("/", $uri));

  $dirs = array_diff(scandir("/mnt/music/$artist_name"), array(".", ".."));

  foreach ($dirs as $dir) {
    echo "<div class='album'>
            <a href='/albums/{$artist_name}/{$dir}'>
              <img src='/music/{$artist_name}/{$dir}/cover.jpg' href='/albums/{$artist_name}/{$dir}' alt='{$dir} cover'><br>
              $dir
            </a>
          </div>";
  }
?>