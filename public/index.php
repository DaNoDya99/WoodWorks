<?php

session_start();

require "../app/configs/init.php";

date_default_timezone_set('Asia/Colombo');


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new App();