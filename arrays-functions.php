<?php
    
    $animals = ["dog", "cat", "elephant", "tiger", "lion", "giraffe", "zebra", "monkey", "kangaroo", "penguin"];

   
    $numberOfAnimals = count($animals);

   
    $teZoekenDier = "lion"; 

  
    $found = in_array($teZoekenDier, $animals);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Animal Search</title>
</head>
<body>
    <h1>Animal Search</h1>

    <p>Number of animals in the array: <?= $numberOfAnimals ?></p>

    <p>Searching for: <?= $teZoekenDier ?></p>

    <?php if ($found): ?>
        <p>The animal "<?= $teZoekenDier ?>" was found in the array.</p>
    <?php else: ?>
        <p>The animal "<?= $teZoekenDier ?>" was not found in the array.</p>
    <?php endif; ?>
</body>
</html>