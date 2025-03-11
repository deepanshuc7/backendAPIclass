<?php
    
    function calculateSum($number1, $number2) {
        return $number1 + $number2;
    }

    function multiply($number1, $number2) {
        return $number1 * $number2;
    }

    function isEven($number) {
        return $number % 2 == 0;
    }

    function stringInfo($str) {
        $length = strlen($str);
        $uppercase = strtoupper($str);
        return ['length' => $length, 'uppercase' => $uppercase];
    }

    $sumResult = calculateSum(5, 10);
    $productResult = multiply(5, 10);
    $isEvenResult = isEven(5);
    $stringInfoResult = stringInfo("Hello World!");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Function Examples</title>
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
    <h1>Function Examples</h1>

    <p>Sum of 5 and 10: <?= $sumResult ?></p>
    <p>Product of 5 and 10: <?= $productResult ?></p>
    <p>Is 5 even? <?= $isEvenResult ? 'Yes' : 'No' ?></p>

    <h2>String Information:</h2>
    <p>Original String: "Hello World!"</p>
    <p>Length: <?= $stringInfoResult['length'] ?></p>
    <p>Uppercase Version: <?= $stringInfoResult['uppercase'] ?></p>
</body>
</html>