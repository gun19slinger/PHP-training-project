<?php

namespace Application;

class Config
{
    use Singleton;

    protected static $data = [];

    protected function __construct()
    {
        static::$data = include __DIR__ . '/../inc/config.php';
    }

    public function getData(string $db_name = null)
    {
        if (null === $db_name) {
            return static::$data;
        } else {
            return static::$data[$db_name];
        }

    }
}