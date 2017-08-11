<?php

namespace LRS\App\Core\Database;

use PDO;

class Connection
{
    public static function make($config)
    {
        try {
            return new PDO(
                "{$config['RDBMS']}:host={$config['host']};dbname={$config['database']}",
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $ex) {
            dd($ex->getMessage());
        }
    }
}
