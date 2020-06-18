<?php
$documentroot = __DIR__;
chdir($documentroot);
require $documentroot . '/../vendor/autoload.php';
spl_autoload_register(function ($class_name) {
    $documentroot = $GLOBALS["documentroot"];
    $filename = $documentroot . "/" . str_replace('\\', '/', $class_name) . ".php";
    if (file_exists($filename)) {
        require $filename;
    }
});
