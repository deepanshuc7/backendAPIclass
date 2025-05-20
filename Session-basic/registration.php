<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['nickname'] = $_POST['nickname'] ?? '';
    header("Location: address.php");
    exit();
}

$focusField = $_GET['edit'] ?? '';
?>

<!DOCTYPE html>
<html>
<head><title>Registration</title></head>
<body>

<h2>Part 1: Registration Details</h2>

<form method="post" action="registration.php">
    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['email'] ?? '') ?>" 
        <?= $focusField === 'email' ? 'autofocus' : '' ?> required><br><br>

    <label>Nickname</label><br>
    <input type="text" name="nickname" value="<?= htmlspecialchars($_SESSION['nickname'] ?? '') ?>" 
        <?= $focusField === 'nickname' ? 'autofocus' : '' ?> required><br><br>

    <button type="submit">Next</button>
</form>

</body>
</html>
