<?php

//this will load the mustache template library
require_once 'mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

// these lines load the artist and artists pages
$artist_html = file_get_contents('templates/artist.html');
$artists_html = file_get_contents('templates/artists.html');

$head = file_get_contents('templates/head.html');
$foot = file_get_contents('templates/foot.html');

$header_data = ["pagetitle" => "player"];
$footer_data = [
];

// get all artists 
$artist_dirs = glob('/mnt/music/*', GLOB_ONLYDIR);
$artists_vars = "";

foreach($artist_dirs as $artist) {
    $artist = basename($artist);

    $artists_vars = $artists_vars . $mustache->render($artist_html, array("name"=>$artist));
    
}

echo $mustache->render($head, $header_data) . PHP_EOL;
echo $mustache->render($artists_html, array("artists"=>$artists_vars)) . PHP_EOL;
echo $mustache->render($foot, $footer_data) . PHP_EOL;
