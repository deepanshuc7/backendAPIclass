<?php
    
    $year = 2024; 

    
    // if ($year % 400 == 0) {
    //     $isLeapYear = true; 
    // } elseif ($year % 100 == 0) {
    //     $isLeapYear = false; 
    // } elseif ($year % 4 == 0) {
    //     $isLeapYear = true; 
    // } else {
    //     $isLeapYear = false; 
    // }

    if(($year%4)==0)
    {
        if(($year%100)==0)
        {
            if(($year%400)==0)
            {
                $isLeapYear = true; 
            }
            else{
                $isLeapYear = false; 
            }
        }
        else{
            $isLeapYear = true; 
        }
    }
    else{
        $isLeapYear = false; 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leap Year sol</title>
</head>
<body>
    <h1>Leap Year Checker</h1>
    <p>The year <?= $year ?> is <?= $isLeapYear ? 'a leap year.' : 'not a leap year.' ?></p>
</body>
</html>