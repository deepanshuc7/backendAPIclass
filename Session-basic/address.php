<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['street'] = $_POST['street'] ?? '';
    $_SESSION['number'] = $_POST['number'] ?? '';
    $_SESSION['city'] = $_POST['city'] ?? '';
    $_SESSION['zipcode'] = $_POST['zipcode'] ?? '';
    header("Location: overview.php");
    exit();
}

$focusField = $_GET['edit'] ?? '';
?>

<!DOCTYPE html>
<html>
<head><title>Address</title></head>
<body>

<h2>Registration Details</h2>
<p>Email: <?= htmlspecialchars($_SESSION['email'] ?? '') ?></p>
<p>Nickname: <?= htmlspecialchars($_SESSION['nickname'] ?? '') ?></p>

<h2>Part 2: Address</h2>

<form method="post" action="address.php">
    <label>Street</label><br>
    <input type="text" name="street" value="<?= htmlspecialchars($_SESSION['street'] ?? '') ?>" 
        <?= $focusField === 'street' ? 'autofocus' : '' ?> required><br><br>

    <label>Number</label><br>
    <input type="text" name="number" value="<?= htmlspecialchars($_SESSION['number'] ?? '') ?>" 
        <?= $focusField === 'number' ? 'autofocus' : '' ?> required><br><br>

    <label>City</label><br>
    <input type="text" name="city" value="<?= htmlspecialchars($_SESSION['city'] ?? '') ?>" 
        <?= $focusField === 'city' ? 'autofocus' : '' ?> required><br><br>

    <label>Zipcode</label><br>
    <input type="text" name="zipcode" value="<?= htmlspecialchars($_SESSION['zipcode'] ?? '') ?>" 
        <?= $focusField === 'zipcode' ? 'autofocus' : '' ?> required><br><br>

    <button type="submit">Next</button>
</form>


</body>
</html>
