<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Bucketlist.php';

$pdo = (new Database())->connect();
$bucketlist = new Bucketlist($pdo);

$name = '';
$description = '';
$priority = '1';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = is_string($_POST['name'] ?? null) ? trim($_POST['name']) : '';
    $description = is_string($_POST['description'] ?? null) ? trim($_POST['description']) : '';
    $priority = $_POST['priority'] ?? '';

    if ($name === '') {
        $errors[] = 'Skriv ett namn.';
    } elseif (mb_strlen($name, 'UTF-8') > 150) {
        $errors[] = 'Namnet får innehålla högst 150 tecken.';
    }

    if ($description === '') {
        $errors[] = 'Skriv en beskrivning.';
    }

    if (!in_array($priority, ['1', '2', '3'], true)) {
        $errors[] = 'Välj en prioritet mellan 1 och 3.';
        $priority = '';
    }

    if ($errors === []) {
        $bucketlist->add($name, $description, (int) $priority);
        header('Location: bucketlist.php', true, 303);
        exit;
    }
}

$items = $bucketlist->getAll();

public function add(string $name, string $description, int $priority): void
{
    $statement = $this->pdo->prepare(
        'INSERT INTO bucketlist_items (name, description, priority)
         VALUES (:name, :description, :priority)'
    );

    $statement->execute([
        'name' => $name,
        'description' => $description,
        'priority' => $priority,
    ]);
}
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