<?php

$filename = realpath('../tests/_files/' . strtolower($_REQUEST['f']) . '.txt');

if (file_exists($filename)) {
    header('Content-Type: text/plain');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    die;
}

header('HTTP/1.0 404 Not Found');
