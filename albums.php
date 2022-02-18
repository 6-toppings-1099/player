<?php

//this will load the mustache template library
require_once 'mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

$url = urldecode($_SERVER["REQUEST_URI"]);

parse_str(parse_url($url, PHP_URL_QUERY), $parsed_url);

$artist = $parsed_url["n"];

$album_html = file_get_contents('templates/album.html');
$albums_html = file_get_contents('templates/albums.html');

$head = file_get_contents('templates/head.html');
$foot = file_get_contents('templates/foot.html');

$header_data = ["pagetitle" => "player"];
$footer_data = [
];

// get all albums 
$album_dirs = glob("/mnt/music/$artist/*", GLOB_ONLYDIR);
$album_vars = "";

foreach($album_dirs as $album) {
    $album = basename($album);

    $album_vars = $album_vars . $mustache->render($album_html, array("image" => "/music/$artist/$album/cover.jpg", "title" => $album, "link" => "songs.php?n=$artist&a=$album"));
    
}

echo $mustache->render($head, $header_data) . PHP_EOL;
echo $mustache->render($albums_html, array("albums" => $album_vars)) . PHP_EOL;
echo $mustache->render($foot, $footer_data) . PHP_EOL;
