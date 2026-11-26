<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/Bucketlist.php';

$pdo = (new Database())->connect();
$bucketlist = new Bucketlist($pdo);

$name = '';
$description = '';
$priority = '1';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = filter_input(INPUT_POST, 'delete_id', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1],
    ]);

    if ($id === false || $id === null) {
        http_response_code(400);
        exit('Ogiltigt id.');
    }

    $bucketlist->delete($id);
    header('Location: bucketlist.php', true, 303);
    exit;
}

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

        <?php if ($errors !== []): ?>
    <ul class="form-errors">
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <form method="post" action="bucketlist.php" class="add-form">
        <p>
            <label for="name">Namn</label>
            <input id="name" name="name" type="text" maxlength="150" required
                value="<?= htmlspecialchars($name) ?>">
        </p>

        <p>
            <label for="description">Beskrivning</label>
            <textarea id="description" name="description" required><?= htmlspecialchars($description) ?></textarea>
        </p>

        <p>
            <label for="priority">Prioritet (1 är högst)</label>
            <select id="priority" name="priority" required>
                <option value="1" <?= $priority === '1' ? 'selected' : '' ?>>1</option>
                <option value="2" <?= $priority === '2' ? 'selected' : '' ?>>2</option>
                <option value="3" <?= $priority === '3' ? 'selected' : '' ?>>3</option>
            </select>
        </p>

        <button type="submit">Lägg till</button>
    </form>

        <?php if ($items === []): ?>
            <p>Din bucketlist är tom.</p>
        <?php else: ?>
            <ul class="bucketlist">
                <?php foreach ($items as $item): ?>
                    <li>
                        <h2><?= htmlspecialchars($item['name']) ?></h2>
                        <p><?= htmlspecialchars($item['description']) ?></p>
                        <p>Prioritet: <?= (int) $item['priority'] ?></p>
                        <p>Tillagd: <?= htmlspecialchars(substr($item['created_at'], 0, 10)) ?></p>

                        <form method="post" action="bucketlist.php">
                            <button type="submit" name="delete_id" value="<?= (int) $item['id'] ?>">
                                Ta bort
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</body>
</html>