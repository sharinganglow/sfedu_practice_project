<?php

namespace App\Models;

class Database
{
    protected static $connection;

    public static function getConnection(): \PDO
    {
        if (self::$connection) {
            return self::$connection;
        }

        $host = 'localhost';
        $db   = 'module_4';
        $user = 'mysql_empl';
        $pass = '322228';
        $charset = 'utf8';

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
