<?php
namespace Mvc\Portfolio\core;


    class registry
    {
        private static $object = [];

        public static function set($key,$value)
        {
            self::$object[$key] = $value;
        }

        public static function get($key)
        {
            return self::$object[$key];
        }
    }