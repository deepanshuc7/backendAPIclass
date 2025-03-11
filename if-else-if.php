<?php
   
    $number = rand(1, 100);

   
    if ($number >= 1 && $number < 10) {
        $lowerBound = 0;
        $upperBound = 10;
    } elseif ($number >= 10 && $number < 20) {
        $lowerBound = 10;
        $upperBound = 20;
    } elseif ($number >= 20 && $number < 30) {
        $lowerBound = 20;
        $upperBound = 30;
    } elseif ($number >= 30 && $number < 40) {
        $lowerBound = 30;
        $upperBound = 40;
    } elseif ($number >= 40 && $number < 50) {
        $lowerBound = 40;
        $upperBound = 50;
    } elseif ($number >= 50 && $number < 60) {
        $lowerBound = 50;
        $upperBound = 60;
    } elseif ($number >= 60 && $number < 70) {
        $lowerBound = 60;
        $upperBound = 70;
    } elseif ($number >= 70 && $number < 80) {
        $lowerBound = 70;
        $upperBound = 80;
    } elseif ($number >= 80 && $number < 90) {
        $lowerBound = 80;
        $upperBound = 90;
    } elseif ($number >= 90 && $number <= 100) {
        $lowerBound = 90;
        $upperBound = 100;
    } else {
        $lowerBound = "invalid";
        $upperBound = "invalid";
    }

   
    $message = "The number lies between $lowerBound and $upperBound.";

    // Reverse the message
    $reversedMessage = strrev($message);
?>

<!DOCTYPE html>
<html>
<head>
    <title>if else if solution</title>
</head>
<body>
    <h1>Number Range Checker</h1>
    <p>Generated Number: <?= $number ?></p>
    <p>Message: <?= $message ?></p>
    <p>Reversed Message: <?= $reversedMessage ?></p>
</body>
</html>