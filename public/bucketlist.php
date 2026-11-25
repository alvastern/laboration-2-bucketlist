<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Bucketlist.php';

$pdo = (new Database())->connect();
$bucketlist = new Bucketlist($pdo);
$items = $bucketlist->getAll();
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Min bucketlist</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php require __DIR__ . '/../includes/nav.php'; ?>

    <main>
        <h1>Min bucketlist</h1>

        <?php if ($items === []): ?>
            <p>Din bucketlist är tom.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($items as $item): ?>
                    <li>
                        <h2><?= htmlspecialchars($item['name']) ?></h2>
                        <p><?= htmlspecialchars($item['description']) ?></p>
                        <p>Prioritet: <?= (int) $item['priority'] ?></p>
                        <p>Tillagd: <?= htmlspecialchars($item['created_at']) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>