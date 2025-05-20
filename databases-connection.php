<?php
$dbFile = __DIR__ . '../database/spotify.sqlite';

try {
    $pdo = new PDO("sqlite:$dbFile");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to database: " . $e->getMessage());
}

$artists = [];
try {
    $stmt = $pdo->query("SELECT Name FROM artists ORDER BY Name ASC");
    $artists = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Error fetching artists: " . $e->getMessage());
}

$customerColumns = [];
try {
    $stmt = $pdo->query("PRAGMA table_info(customers)");
    $customerColumns = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching customer columns: " . $e->getMessage());
}

$tables = [];
try {
    $stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    die("Error fetching tables: " . $e->getMessage());
}

$searchedTable = $_GET['table'] ?? '';

$showResult = false;
$columns = [];

if ($searchedTable !== '') {
    $showResult = true;
    if (in_array($searchedTable, $tables, true)) {
        $stmt = $pdo->query("PRAGMA table_info($searchedTable)");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $columns = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Spotify Database Explorer</title>
</head>
<body>

<h1>Artists (A-Z)</h1>
<ul>
    <?php foreach ($artists as $artist): ?>
        <li><?= htmlspecialchars($artist) ?></li>
    <?php endforeach; ?>
</ul>

<h2>Customer table columns:</h2>
<ul>
    <?php foreach ($customerColumns as $col): ?>
        <li><?= htmlspecialchars($col['name']) ?></li>
    <?php endforeach; ?>
</ul>

<h2>List the columns of a specific table</h2>

<form method="GET" action="">
    <label for="table">Table name:</label>
    <input type="text" id="table" name="table" value="<?= htmlspecialchars($searchedTable) ?>" required />
    <input type="submit" value="Search" />
</form>

<?php if ($showResult): ?>
    <h3>Result:</h3>
    <?php if (!empty($columns)): ?>
        <ul>
            <?php foreach ($columns as $col): ?>
                <li><?= htmlspecialchars($col['name']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>There are no results for table "<?= htmlspecialchars($searchedTable) ?>"</p>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
