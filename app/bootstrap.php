<?php 
// Loading Config
require_once "config/config.php";
// Btn Provider 
require_once "helpers/btnProvider.php";

// Auto Loader Classes
spl_autoload_register(function ($classname) {
    require_once "libs/" . $classname . ".php";
});

?>