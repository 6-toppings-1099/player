<?php
  $dirs = array_diff(scandir("/mnt/music"), array(".", "..", "record.txt"));

  foreach ($dirs as $dir) {
    echo "<a class='artist' href='/artists/{$dir}'>{$dir}</a>";
  }
?>