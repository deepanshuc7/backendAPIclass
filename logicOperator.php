<?php
        // Part 1: String Evaluation
        $textToCheck = "ThomasMore"; 

        // Check 1: More than 5 characters AND starts with a capital letter
        $check1 = (strlen($textToCheck) > 5) && (ctype_upper($textToCheck[0]));

        // Check 2: More than 5 characters OR contains the letter 'e'
        $check2 = (strlen($textToCheck) > 5) || (strpos($textToCheck, 'e') !== false);

        // Check 3: More than 5 characters
        $check3 = strlen($textToCheck) > 5;

        // Check 3b: Same as Check 3, written differently
        $check3b = !(strlen($textToCheck) <= 5);

        // Part 2: Year and Month Evaluation
        $yearOfBirth = 2001; 
        $monthOfBirth = 4;   

        // Evaluate conditions
        $condition = ($yearOfBirth % 2 != 0 || $yearOfBirth > 1994) || ($monthOfBirth <= 6);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logic Operators Assignment</title>
    <style>
       
        .applicable {
            background-color: green;
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
    

    <h1>Part 1: String Evaluation</h1>
    <p>Text to Check: <strong><?php echo $textToCheck; ?></strong></p>
    <p>Check 1 (More than 5 characters AND starts with a capital): <?php echo $check1 ? 'true' : 'false'; ?></p>
    <p>Check 2 (More than 5 characters OR contains 'e'): <?php echo $check2 ? 'true' : 'false'; ?></p>
    <p>Check 3 (More than 5 characters): <?php echo $check3 ? 'true' : 'false'; ?></p>
    <p>Check 3b (More than 5 characters, written differently): <?php echo $check3b ? 'true' : 'false'; ?></p>

    <h1>Part 2: Year and Month Evaluation</h1>
    <?php if ($condition): ?>
        <p class="applicable">You apply</p>
    <?php else: ?>
        <p>You do not apply</p>
    <?php endif; ?>
</body>
</html>