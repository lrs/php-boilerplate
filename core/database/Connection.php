<?php
/**
 * <Description>
 * PHP version 7
 *
 * @category Core
 * @package  LRS\App\Core\Database
 * @author   LRS <lee.spendlove@design-fu.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://localhost
 */
namespace LRS\App\Core\Database;

use PDO;
use PDOException;

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
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
