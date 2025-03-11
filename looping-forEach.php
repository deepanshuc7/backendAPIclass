<?php

    $text = file_get_contents('text-file.txt');

    $textChars = str_split($text);

    rsort($textChars);

    $textChars = array_reverse($textChars);

    $charCount = [];
    foreach ($textChars as $char) {
        if (isset($charCount[$char])) {
            $charCount[$char]++;
        } else {
            $charCount[$char] = 1;
        }
    }
    
    $totalDifferentChars = count($charCount);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Character Counter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        p {
            font-size: 18px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Character Counter</h1>

    <p>Total number of different characters: <?= $totalDifferentChars ?></p>

    <h2>Character Occurrences:</h2>
    <ul>
        <?php foreach ($charCount as $char => $count): ?>
            <li>Character '<?= $char ?>' occurs <?= $count ?> time(s).</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>