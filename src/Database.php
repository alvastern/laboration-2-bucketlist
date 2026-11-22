<?php

class Database
{
    public function connect(): PDO
    {
        $config = require __DIR__ . '/../config.local.php';

        return new PDO(
            'mysql:host=127.0.0.1;port=3306;dbname=bucketlist;charset=utf8mb4',
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}