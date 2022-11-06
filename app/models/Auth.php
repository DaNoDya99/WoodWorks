<?php

class Auth
{
    public static function authenticate($row)
    {
        if(is_object($row)){
            $_SESSION['USER_DATA'] = $row;
        }
    }

    public static function logout()
    {
        if(!empty($_SESSION['USER_DATA'])){
            unset($_SESSION['USER_DATA']);
            //session_unset();
            //session_regenerate_id();
        }
    }

    public static function logged_in()
    {
        if(!empty($_SESSION['USER_DATA']))
        {
            return true;
        }

        return false;
    }

    public static function __callStatic($name, $arguments)
    {
        $key = str_replace("get","",$name);

        if(!empty($_SESSION['USER_DATA']->$key))
        {
            return $_SESSION['USER_DATA']->$key;
        }

        return '';
    }
}