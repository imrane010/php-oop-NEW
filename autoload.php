<?php

spl_autoload_register(function ($class) {
    // Converteer namespace naar bestandspad
    $path = str_replace("\\", "/", $class) . ".php";

    if (file_exists($path)) {
        require_once $path;
    } else {
        die("Class $class not found!");
    }
});

?>
