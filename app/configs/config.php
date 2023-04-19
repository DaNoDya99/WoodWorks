<?php

define('APPNAME','WoodWorks');


if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define('DBHOST','localhost');
    define('DBNAME','woodworks2');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
    define('ROOT','http://localhost/WoodWorks/public');

}else{
    define('DBHOST','localhost');
    define('DBNAME','woodworks');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBDRIVER','mysql');
    define('ROOT',$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/WoodWorks/public');
}