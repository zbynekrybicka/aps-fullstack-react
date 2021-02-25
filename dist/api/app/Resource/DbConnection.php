<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.01.2021
 * Time: 21:52
 */

namespace App\Resource;


use Dibi\Connection;

class DbConnection
{
    public static function get() {
        static $dbConnection = null;
        if (!$dbConnection) {
            $dbConnection = new Connection([
                'host' => 'mysql',
                'port' => 3306,
                'user' => 'root',
                'password' => 'password',
                'database' => 'db'
            ]);
        }
        return $dbConnection;
    }

}