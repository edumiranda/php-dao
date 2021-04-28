<?php

spl_autoload_register(function($class_name){
    $fn = "class" . DIRECTORY_SEPARATOR . $class_name . ".php";
    if(file_exists($fn)){
        require_once($fn);
    }
});

?>