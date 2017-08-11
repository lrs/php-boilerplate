<?php

namespace LRS\App\Core;

use Exception;

// simple Dependency Injection container.
class App
{
    protected static $registory = [];

    public static function bind($key, $value)
    {
        static::$registory[$key] = $value;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$registory)) {
            throw new Exception("No {$key} is bound in the container");
        }

        return static::$registory[$key];
    }
}
