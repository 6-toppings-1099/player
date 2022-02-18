<?php

//this will load the mustache template library
require_once 'mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

$url = urldecode($_SERVER["REQUEST_URI"]);

parse_str(parse_url($url, PHP_URL_QUERY), $parsed_url);

$artist = $parsed_url["n"];
$album = $parsed_url["a"];


$song_html = file_get_contents('templates/song.html');
$songs_html = file_get_contents('templates/songs.html');

$head = file_get_contents('templates/head.html');
$foot = file_get_contents('templates/foot.html');

$header_data = ["pagetitle" => "player"];
$footer_data = [
];

// get all songs 
$song_dirs = glob("/mnt/music/$artist/$album/*.{mp3,flac}", GLOB_BRACE);
$song_vars = "";

foreach($song_dirs as $song) {
    $song = basename($song);

    $title = implode('.', explode('.', explode(' - ', $song, 2)[1], -1)); 

    $song_vars = $song_vars . $mustache->render($song_html, array("title" => $title, "src" => "music/$artist/$album/$song", "artist" => $artist, "album" => $album));
    
}

echo $mustache->render($head, $header_data) . PHP_EOL;
echo $mustache->render($songs_html, array("songs" => $song_vars)) . PHP_EOL;
echo $mustache->render($foot, $footer_data) . PHP_EOL;
