<?php

    $number = 3; 

    switch ($number) {
        case 1:
            $day = "monday";
            break;
        case 2:
            $day = "tuesday";
            break;
        case 3:
            $day = "wednesday";
            break;
        case 4:
            $day = "thursday";
            break;
        case 5:
            $day = "friday";
            break;
        case 6:
            $day = "saturday";
            break;
        case 7:
            $day = "sunday";
            break;
        default:
            $day = "invalid number";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>switch statement</title>
</head>
<body>
    <h1>Day of the Week</h1>
    <p>The day corresponding to the number <?= $number ?> is: <?= $day ?></p>
</body>
</html>