<?php

spl_autoload_register(function($class_name)
{
    $parts = explode("\\", $class_name);
    $class_name = array_pop($parts);

    require_once "../app/models/" .$class_name . ".php";
});

require "config.php";
require "functions.php";
require "database.php";
require "model.php";
require "controller.php";
require "app.php";