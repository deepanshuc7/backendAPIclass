<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head><title>Overview</title></head>
<body>

<h2>Overview Page</h2>

<p>Email: <?= htmlspecialchars($_SESSION['email'] ?? '') ?> |
    <a href="registration.php?edit=email">Edit</a></p>

<p>Nickname: <?= htmlspecialchars($_SESSION['nickname'] ?? '') ?> |
    <a href="registration.php?edit=nickname">Edit</a></p>

<p>Street: <?= htmlspecialchars($_SESSION['street'] ?? '') ?> |
    <a href="address.php?edit=street">Edit</a></p>

<p>Number: <?= htmlspecialchars($_SESSION['number'] ?? '') ?> |
    <a href="address.php?edit=number">Edit</a></p>

<p>City: <?= htmlspecialchars($_SESSION['city'] ?? '') ?> |
    <a href="address.php?edit=city">Edit</a></p>

<p>Zipcode: <?= htmlspecialchars($_SESSION['zipcode'] ?? '') ?> |
    <a href="address.php?edit=zipcode">Edit</a></p>



</body>
</html>
