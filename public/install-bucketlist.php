<?php

header('Cache-Control: no-store');

$key = $_GET['key'] ?? '';
if (!is_string($key) || !hash_equals('49bb2a0550944790ad2f6e84a5155950', $key)) {
    http_response_code(404);
    exit;
}

require_once __DIR__ . '/../src/Database.php';

header('Content-Type: text/plain; charset=UTF-8');

$sql = file_get_contents(__DIR__ . '/../database/install.sql');

if ($sql === false) {
    http_response_code(500);
    exit('Hittar inte database/install.sql på servern.');
}

if (!class_exists('PDO') || !in_array('mysql', PDO::getAvailableDrivers(), true)) {
    exit('PDO MySQL saknas på MIUN-servern.');
}

try {
    $pdo = (new Database())->connect();
    $pdo->exec($sql);
    echo 'Installationen lyckades.';
} catch (PDOException $error) {
    http_response_code(500);
    echo $error->getMessage();
}