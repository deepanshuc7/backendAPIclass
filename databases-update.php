<?php
$dbFile = __DIR__ . '../database/back-end-users-exercise.sqlite';
$db = new SQLite3($dbFile);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_id'])) {
    $id = (int)$_POST['update_id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username !== '' && $password !== '') {
        $stmt = $db->prepare("UPDATE users SET username = :username, password = :password WHERE id = :id");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();
        $message = "User ID $id updated successfully.";
    } else {
        $message = "Username and password cannot be empty.";
    }
}

$results = $db->query("SELECT id, username, password FROM users WHERE SoftDeleted = 0 ORDER BY id ASC");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #eee;
        }
        form {
            display: inline;
        }
        .message {
            width: 80%;
            margin: 10px auto;
            padding: 10px;
            background-color: #e0ffe0;
            border: 1px solid #b3ffb3;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">User Dashboard - Edit Info</h2>

<?php if (isset($message)) : ?>
    <div class="message"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)) : ?>
        <tr>
            <form method="post" action="">
                <td><?= $row['id'] ?></td>
                <td>
                    <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" required>
                </td>
                <td>
                    <input type="text" name="password" value="<?= htmlspecialchars($row['password']) ?>" required>
                </td>
                <td>
                    <input type="hidden" name="update_id" value="<?= $row['id'] ?>">
                    <button type="submit">Update</button>
                </td>
            </form>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
