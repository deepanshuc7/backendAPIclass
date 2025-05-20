<?php
$db = new SQLite3(__DIR__ . '../database/back-end-users-exercise.sqlite');

// Soft delete
if (isset($_GET['confirm_delete_id'])) {
    $id = (int) $_GET['confirm_delete_id'];
    $stmt = $db->prepare("UPDATE users SET SoftDeleted = 1 WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    header("Location: databases-delete.php");
    exit;
}

if (isset($_GET['cancel'])) {
    header("Location: databases-delete.php");
    exit;
}


$confirmDeleteId = $_GET['delete_id'] ?? null;
$confirmUser = null;
if ($confirmDeleteId) {
    $stmt = $db->prepare("SELECT id, username FROM users WHERE id = :id AND SoftDeleted = 0");
    $stmt->bindValue(':id', $confirmDeleteId, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $confirmUser = $result->fetchArray(SQLITE3_ASSOC);
}


$results = $db->query("SELECT id, username, password FROM users WHERE SoftDeleted = 0 ORDER BY id ASC");
$users = [];
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $users[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        a.delete-btn {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        .confirm-box {
            background-color: #fff3cd;
            padding: 15px;
            border: 1px solid #ffeeba;
            margin-top: 20px;
        }
        .confirm-actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 4px;
        }
        .btn-delete {
            background-color: red;
            color: white;
        }
        .btn-cancel {
            background-color: gray;
            color: white;
        }
    </style>
</head>
<body>

<h2>Dashboard</h2>

<?php if ($confirmUser): ?>
    <div class="confirm-box">
        <p>You are about to delete "<strong><?= htmlspecialchars($confirmUser['username']) ?></strong>" (id: <?= $confirmUser['id'] ?>). Are you sure?</p>
        <div class="confirm-actions">
            <a class="btn-delete" href="?confirm_delete_id=<?= $confirmUser['id'] ?>">Delete</a>
            <a class="btn-cancel" href="?cancel=1">Cancel</a>
        </div>
    </div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>password</th>
            <th>action</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($users)): ?>
        <tr><td colspan="4">No active users found.</td></tr>
    <?php else: ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['password']) ?></td>
                <td><a class="delete-btn" href="?delete_id=<?= $user['id'] ?>">[x]</a></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>
