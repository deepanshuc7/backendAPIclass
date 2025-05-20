<?php

session_start();

$users = [];
if (file_exists("cookie-basic.txt")) {
    $lines = file("cookie-basic.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($username, $password) = explode(",", trim($line));
        $users[trim($username)] = trim($password);
    }
}

if (isset($_GET['logout'])) {
    setcookie("user_login", "", time() - 3600, "/");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

$error = "";
$loggedInUser = null;

if (isset($_POST['submit'])) {
    $inputUsername = trim($_POST['username']);
    $inputPassword = trim($_POST['password']);
    $remember = isset($_POST['remember']);

    if (isset($users[$inputUsername]) && $users[$inputUsername] === $inputPassword) {
        $expiry = $remember ? time() + (30 * 24 * 60 * 60) : 0; // 30 days or session cookie
        setcookie("user_login", $inputUsername, $remember ? $expiry : 0, "/");
        $loggedInUser = $inputUsername;
    } else {
        $error = "Username and/or password incorrect. Try again.";
    }
} elseif (isset($_COOKIE['user_login'])) {
    $loggedInUser = $_COOKIE['user_login'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login with Cookie</title>
</head>
<body>

<?php if ($loggedInUser): ?>
    <h1>Dashboard</h1>
    <p>Hello <strong><?= htmlspecialchars($loggedInUser) ?></strong>, glad to have you back!</p>
    <a href="?logout=true">Logout</a>
<?php else: ?>
    <h1>Login</h1>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label>
            <input type="checkbox" name="remember"> Remember me
        </label><br><br>

        <button type="submit" name="submit">Login</button>
    </form>
<?php endif; ?>

</body>
</html>
