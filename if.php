<?php
        
        $number = 2; 

        if ($number == 1) {
            $day = "monday";
        } elseif ($number == 2) {
            $day = "tuesday";
        } elseif ($number == 3) {
            $day = "wednesday";
        } elseif ($number == 4) {
            $day = "thursday";
        } elseif ($number == 5) {
            $day = "friday";
        } elseif ($number == 6) {
            $day = "saturday";
        } elseif ($number == 7) {
            $day = "sunday";
        } else {
            $day = "invalid number"; 
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Day of the Week</title>
</head>
<body>
    <h1>Day of the Week</h1>
    

        
       <p>The day corresponding to the number <?= $number ?> is: <?= $day ?> </p>;

    
</body>
</html>