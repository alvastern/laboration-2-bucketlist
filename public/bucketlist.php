<?php
require_once __DIR__ . '/../src/Database.php';

$pdo = (new Database())->connect();
$count = $pdo->query('SELECT COUNT(*) FROM bucketlist_items')->fetchColumn();

echo '<p>Antal poster i databasen: ' . (int) $count . '</p>';
?>