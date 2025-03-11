<?php
   
    $animals1 = array("dog", "cat", "elephant", "tiger", "lion", "giraffe", "zebra", "monkey", "kangaroo", "penguin");


    $animals2 = ["dog", "cat", "elephant", "tiger", "lion", "giraffe", "zebra", "monkey", "kangaroo", "penguin"];

  
    $vehicles = [
        'landVehicles' => ['Vespa', 'bicycle', 'motorcycle', 'bus', 'truck' ],

        'airVehicles' => ['hot air balloon', 'helicopter', 'B52']
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Arrays in PHP</title>
</head>
<body>
    <h1>Arrays in PHP</h1>

    <h2>Animals Array (Method 1)</h2>
    <pre><?php var_dump($animals1); ?></pre>

    <h2>Animals Array (Method 2)</h2>
    <pre><?php var_dump($animals2); ?></pre>

    <h2>Vehicles Array (Categorized)</h2>
    <pre><?php var_dump($vehicles); ?></pre>
</body>
</html>