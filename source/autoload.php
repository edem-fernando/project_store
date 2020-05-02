<?php

require __DIR__ . "/Config/config.php";
require __DIR__ . "/Helpers/helpers.php";

spl_autoload_register(function ($class) {
    $namespace = "Source\\";
    $baseDir = __DIR__ . "/";
    $len = strlen($namespace);

    if (strncmp($namespace, $class, $len !== 0)) {
        return;
    } else {
        $relativeClass = substr($class, $len);
        $file = $baseDir . str_replace("\\", "/", $relativeClass) . ".php";

        if (file_exists($file)) {
            require $file;
        }
    }
});
