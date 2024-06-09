<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

$api = new API();
$api->processApi();

// print_r($_GET);

// print_r($_SERVER);
// $path = trim($_SERVER['REQUEST_URI'], '/');
// // print_r (explode('/', $path));
// echo $path;