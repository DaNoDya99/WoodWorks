<?php

class Controller
{
    function view($view,$data = [])
    {
        extract($data); //Make variables using array value names.

        $filename = "../app/views/".$view.".view.php";

        if(file_exists($filename)){
            require $filename;
        }else{
            echo "Could not find the view file ".$filename;
        }
    }
}