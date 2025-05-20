<?php
$username = 'thomasmore';
$password = 'password';
$message = '';

if (isset($_POST['submit'])) {
    $inputUsername = $_POST['username'] ?? '';
    $inputPassword = $_POST['password'] ?? '';

    if ($inputUsername === $username && $inputPassword === $password) {
        $message = 'Welcome';
    } else {
        $message = 'Login failed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Login</title>
<style>
    body { font-family: Arial; padding: 20px; background: #f4f4f4; }
    form { background: white; max-width: 400px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
    label { display: block; margin-top: 10px; font-weight: bold; }
    input[type=text], input[type=password] { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
    input[type=submit] { margin-top: 15px; padding: 10px 20px; background: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; }
    .message { text-align: center; margin-top: 15px; font-weight: bold; }
    .message.success { color: green; }
    .message.error { color: red; }
</style>
</head>
<body>

<form method="POST" action="">
    <h2>Login</h2>
    <label for="username">Username</label>
    <input id="username" name="username" type="text" required />

    <label for="password">Password</label>
    <input id="password" name="password" type="password" required />

    <input type="submit" name="submit" value="Login" />
</form>

<?php if ($message !== ''): ?>
    <div class="message <?= $message === 'Welcome' ? 'success' : 'error' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

</body>
</html>
