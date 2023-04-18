<?php

class App
{
    protected $contoller = '_404';
    protected  $method = 'index';
    public static $page = '_404';

    protected $timer = 3600;

    function __construct(){
        $url = $this->getURL(); //this in here represents App class
        $filename = "../app/controllers/".ucfirst($url[0]).".php";
        if(file_exists($filename)){
            require $filename;
            $this->contoller = $url[0];
            self::$page = $url[0];
            unset($url[0]);
        }else{
            require "../app/controllers/".$this->contoller.".php";
        }

        $mycontroller = new $this->contoller();

        if(isset($url[1])) {
            if (method_exists($mycontroller, strtolower($url[1]))) {
                $this->method = strtolower($url[1]);
                unset($url[1]);
            }
        }

        $url = array_values($url);
        call_user_func_array([$mycontroller,$this->method],$url); // ([object,method], parameters)

//        show($_SESSION['cart']);
//        unset($_SESSION['cart']);

        Auth::cartTimer($this->timer);
    }

    private function getURL(){
        $url = $_GET['url'] ?? 'home'; #get the URL
        $url = filter_var($url,FILTER_SANITIZE_URL); //filter the url, removes all unnecessary characters
        $arr = explode("/",$url); #split
        return $arr;
    }
}