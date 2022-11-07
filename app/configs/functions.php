<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function str_to_url($url)
{

    $url = str_replace("'", "", $url);
    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
    $url = trim($url, "-");
    $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
    $url = strtolower($url);
    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

    return $url;
}

function set_value($key, $default = '')
{

    if(!empty($_POST[$key]))
    {
        return $_POST[$key];
    }else if(!empty($default))
    {
        return $default;
    }

    return '';
}