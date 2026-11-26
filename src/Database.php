<?php

class Database
{
    public function connect(): PDO
    {
        $serverConfig = '/userhome/alst2511/bucketlist-app/config.local.php';
        $localConfig = __DIR__ . '/../config.local.php';

        $config = require (is_file($serverConfig) ? $serverConfig : $localConfig);

        return new PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}