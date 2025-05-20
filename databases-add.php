<?php
$dbFile = __DIR__ . '../database/back-end-users-exercise.sqlite';

$db = new SQLite3($dbFile);

$db->exec("CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
)");

$username = '';
$password = '';
$password_confirm = '';
$errors = ['username' => '', 'password' => '', 'password_confirm' => ''];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if ($username === '') {
        $errors['username'] = 'Username cannot be empty.';
    } else {
        $stmt = $db->prepare('SELECT COUNT(*) as count FROM users WHERE username = :username');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
        if ($result['count'] > 0) {
            $errors['username'] = 'Username already exists. Please choose another.';
        }
    }

    if ($password === '') {
        $errors['password'] = 'Password cannot be empty.';
    } else {
        if (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long.';
        }
        if (!preg_match('/[!?\@_]/', $password)) {
            $errors['password'] = ($errors['password'] ? $errors['password'] . ' ' : '') . 'Password must contain at least one special character (! ? @ _).';
        }
    }

    if ($password_confirm === '') {
        $errors['password_confirm'] = 'Please confirm your password.';
    } elseif ($password !== $password_confirm) {
        $errors['password_confirm'] = 'Passwords do not match.';
    }

    if (empty(array_filter($errors))) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $passwordHash, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "User <b>" . htmlspecialchars($username) . "</b> registered successfully!";
            $username = '';
            $password = '';
            $password_confirm = '';
        } else {
            $errors['username'] = 'Failed to register user due to a database error.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Register User</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        max-width: 500px;
        margin: auto;
        background-color: #f5f5f5;
    }
    form {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    label {
        display: block;
        margin-top: 15px;
        font-weight: bold;
    }
    input[type=text], input[type=password] {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        box-sizing: border-box;
    }
    .error {
        color: red;
        font-size: 0.9em;
        margin-top: 3px;
    }
    .success {
        color: green;
        font-weight: bold;
        margin-bottom: 15px;
    }
    button {
        margin-top: 20px;
        padding: 10px 15px;
        background-color: #2196F3;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0b7dda;
    }
</style>
</head>
<body>

<h2>Register User</h2>

<?php if ($successMessage): ?>
    <p class="success"><?= $successMessage ?></p>
<?php endif; ?>

<form method="POST" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" value="<?= htmlspecialchars($username) ?>" />
    <?php if ($errors['username']): ?>
        <div class="error"><?= $errors['username'] ?></div>
    <?php endif; ?>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" value="" />
    <?php if ($errors['password']): ?>
        <div class="error"><?= $errors['password'] ?></div>
    <?php endif; ?>

    <label for="password_confirm">Confirm Password:</label>
    <input type="password" id="password_confirm" name="password_confirm" value="" />
    <?php if ($errors['password_confirm']): ?>
        <div class="error"><?= $errors['password_confirm'] ?></div>
    <?php endif; ?>

    <button type="submit">Register</button>
</form>

</body>
</html>
