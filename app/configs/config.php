<?php

define('APPNAME','WoodWorks App');

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBHOST','localhost');
    define('DBNAME','woodworks');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
}else{
    define('DBHOST','localhost');
    define('DBNAME','woodworks');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
}