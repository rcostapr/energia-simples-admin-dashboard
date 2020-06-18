<?php
require __DIR__ . '/../../vendor/autoload.php';
spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . "/../" . str_replace('\\', '/', $class_name) . ".php";
    // if the file exists, require it
    if (file_exists($filename)) {
        require $filename;
    }
});
