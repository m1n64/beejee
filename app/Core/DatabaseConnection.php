<?php

namespace Beejee\App\Core;

use PDO;

class DatabaseConnection
{
    const TYPE = "mysql";

    const HOST = "127.0.0.1";
    const DB = "beejee_db";
    const USER = "user1";
    const PASS = "user1";

    public static function connect(): PDO
    {
        return new PDO(self::TYPE.':host='.self::HOST.';dbname='.self::DB, self::USER, self::PASS);
    }
}