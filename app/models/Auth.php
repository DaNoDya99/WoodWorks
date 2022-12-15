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
            session_destroy();

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

    public static function checkPerson($role)
    {
        if (strtolower($_SESSION['USER_DATA'] -> Role) == $role){
            return true;
        }
        return false;
    }

    public static function __callStatic($name, $arguments)
    {
        $key = str_replace("get","",$name);
        //print_r($key);

        if(!empty($_SESSION['USER_DATA']->$key))
        {
            return $_SESSION['USER_DATA']->$key;
        }

        return '';
    }
}