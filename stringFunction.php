<?php

    $fruit = "coconut";
    $length = strlen($fruit);
    $position = strpos($fruit, "o");

    $fruit2 = "pineapple"; 
    $fruit2Needle = "a";
    $lastPosition = strrpos($fruit2, $fruit2Needle);
    $uppercaseFruit = strtoupper($fruit2);

    $letter = "e";
    $number = "3";
    $longestWord = "pneumonoultramicroscopicsilicovolcanoconiosis";
    $newWord = str_replace($letter, $number, $longestWord);     

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
        <h1>String functions</h1>

        <h2>Part 1</h2>

        <p>The length of <?= $fruit ?> is <?= $length ?></p>
        <p>The position of the first 'o' is: <?= $position ?></p>

        <h2>Part 2</h2>
        <p>The position of the last '<?= $fruit2Needle?>' is: <?= $lastPosition ?></p>
        <p>The uppercase value of <?= $fruit ?> is <?= $uppercaseFruit ?></p>

        <h2>Part 3</h2>

        <p>The modified word is: <?= $newWord ?></p>

    </body>
</html>