<?php
   
    $md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';

    function first($needle) {
        global $md5HashKey;
        $count = substr_count($md5HashKey, $needle);
        return $count;
    }

    function second($needle) {
        $count = substr_count($GLOBALS['md5HashKey'], $needle);
        return $count;
    }

    function third($needle, $hashKey) {
        $count = substr_count($hashKey, $needle);
        return $count;
    }

    $count1 = first('6');
    $count2 = second('9');
    $count3 = third('d', $md5HashKey);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MD5 Hash Key Analysis</title>
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
    </style>
</head>
<body>
    <h1>MD5 Hash Key Analysis</h1>

    <p>Function 1: The needle '2' occurs <?= $count1 ?> time(s) in the hash key '<?= $md5HashKey ?>'.</p>
    <p>Function 2: The needle '8' occurs <?= $count2 ?> time(s) in the hash key '<?= $md5HashKey ?>'.</p>
    <p>Function 3: The needle 'a' occurs <?= $count3 ?> time(s) in the hash key '<?= $md5HashKey ?>'.</p>
</body>
</html>