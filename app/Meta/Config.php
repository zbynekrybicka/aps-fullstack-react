<?php

namespace App\Meta;


class Config
{
    public static $config;

    public static function load($config) {
        self::$config = $config;
    }

}