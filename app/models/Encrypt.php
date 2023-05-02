<?php

class Encrypt
{
    public static function encrypt($string)
    {
        $enc = openssl_encrypt($string, $_ENV['ENCRYPTION_ALGO'], $_ENV['ENCRYPTION_KEY'],OPENSSL_RAW_DATA, $_ENV['ENCRYPTION_IV'], $_ENV['PADDING']);
        return base64_encode($enc);
    }

    public static function decrypt($string)
    {
        $string = base64_decode($string);
        return openssl_decrypt($string, $_ENV['ENCRYPTION_ALGO'], $_ENV['ENCRYPTION_KEY'],OPENSSL_RAW_DATA,$_ENV['ENCRYPTION_IV'], $_ENV['PADDING']);
    }
}