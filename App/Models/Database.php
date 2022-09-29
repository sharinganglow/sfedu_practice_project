<?php

namespace App\Models;

use App\Models\Environment\Environment;

class Database
{
    protected static $connection;

    public static function getConnection(): \PDO
    {
        if (self::$connection) {
            return self::$connection;
        }

        $env = Environment::checkInstance();

        $host = $env->getHost();
        $db   = $env->getName();
        $user = $env->getUser();
        $pass = $env->getPassword();
        $charset = $env->getCharset();

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        self::$connection = new \PDO($dsn, $user, $pass, $opt);
        return self::$connection;
    }
}
