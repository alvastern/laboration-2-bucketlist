<?php

class Database
{
    public function connect(): PDO
    {
        $serverConfig = __DIR__ . '/../config.miun.php';
        $localConfig = __DIR__ . '/../config.local.php';

        $configFile = is_file($serverConfig) ? $serverConfig : $localConfig;
        $config = require $configFile;

        return new PDO(
            $config['dsn'],
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}