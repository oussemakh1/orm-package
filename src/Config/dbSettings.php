<?php
/**
 * Created by PhpStorm.
 * User: Oussema
 * Date: 1/31/2021
 * Time: 7:07 PM
 */

namespace App\Database\Config;


class dbSettings
{
    static $host, $username,$password,$database;

    public function __construct() {
        self::$host = getenv('localhost');
        self::$username = getenv('username');
        self::$password = getenv('password');
        self::$database = getenv('database');
    
    }
   
    public static function set()
    {
        return define("HOST",self::$host) .define("USERNAME",self::$username) .define("PASSWORD",self::$password) .define("DATABASE",self::$database);
    }


}