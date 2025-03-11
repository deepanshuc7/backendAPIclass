<?php
    $initialAmount = 100000;

    $interestRate = 0.08;

    $years = 10;

    function calculateAmount($amount, $interestRate, $years, $currentYear = 1) {

        $amount *= (1 + $interestRate);
        $amount = floor($amount); 

        echo "<p>Year $currentYear: €$amount</p>";

        if ($currentYear >= $years) {
            return $amount;
        }

        return calculateAmount($amount, $interestRate, $years, $currentYear + 1);
    }

    $finalAmount = calculateAmount($initialAmount, $interestRate, $years);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hans' Investment</title>
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
    <h1>Hans' Investment Over 10 Years</h1>

    <p>Initial Amount: €<?= $initialAmount ?></p>
    <p>Interest Rate: <?= $interestRate * 100 ?>%</p>
    <p>Years: <?= $years ?></p>

    <h2>Yearly Growth:</h2>
    <?php
       
        calculateAmount($initialAmount, $interestRate, $years);
    ?>

    <h2>Final Amount After 10 Years:</h2>
    <p>€<?= $finalAmount ?></p>
</body>
</html>