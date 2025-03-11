<?php

    $firstName = "Deep";
    
    $lastName = "Chaudhary";

    $fullName = $firstName . ' ' . $lastName;

    $fullNameLength = strlen($fullName);

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="/css/global.css">
        <link rel="stylesheet" type="text/css" href="/css/directory.css">
        <link rel="stylesheet" type="text/css" href="/css/facade.css">
    </head>
    <body >
		<h1>String concatenation</h1>

        <p><?= $fullName ?></p>
        <p><?= $firstName ?> <?= $lastName ?></p>
        <p>The name "<?= $fullName ?>" contains <?= $fullNameLength ?> characters</p>

    </body>
</html>
