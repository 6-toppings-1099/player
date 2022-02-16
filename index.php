<?php

//this will load the mustache template library
require_once 'mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// this will create a new mustache template engine
$mustache = new Mustache_Engine;

// these lines load your header, footer, and body template into strings
$head = file_get_contents('templates/head.html');
$frame = file_get_contents('templates/frame.html');
$foot = file_get_contents('templates/foot.html');

$header_data = ["pagetitle" => "player"];
$frame_data = ["src" => "artists.php"];
$footer_data = [
];

echo $mustache->render($head, $header_data) . PHP_EOL;
echo $mustache->render($frame, $frame_data) . PHP_EOL;
echo $mustache->render($foot, $footer_data) . PHP_EOL;
