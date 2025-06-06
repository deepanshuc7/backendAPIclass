<?php
    // Part 1: Print numbers from 0 to 100
    $i = 0;
    $numbers = "";
    while ($i <= 100) {
        $numbers .= $i;
        if ($i != 100) {
            $numbers .= ", ";
        }
        $i++;
    }

    // Part 1: Print numbers divisible by 3, greater than 40, and smaller than 80
    $i = 41;
    $filteredNumbers = "";
    while ($i < 80) {
        if ($i % 3 == 0) {
            $filteredNumbers .= $i . " ";
        }
        $i++;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Looping Statements</title>
    <style>
 
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .even {
            background-color: #4CAF50;
            color: white;
        }

    
        .part1 {
            margin-bottom: 30px;
        }

        .part1 p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Part 1: Number Printing</h1>
    <div class="part1">
        <p>Numbers from 0 to 100: <?= $numbers ?></p>
        <p>Numbers divisible by 3, greater than 40, and smaller than 80: <?= $filteredNumbers ?></p>
    </div>

    <h1>Part 2: Multiplication Tables</h1>
    <table>
        <tr>
            <th>Multiplication Tables</th>
            <?php for ($col = 1; $col <= 10; $col++): ?>
                <th><?= $col ?></th>
            <?php endfor; ?>
        </tr>
        <?php for ($row = 0; $row <= 10; $row++): ?>
            <tr>
                <td><?= $row ?></td>
                <?php for ($col = 1; $col <= 10; $col++): ?>
                    <?php
                        $result = $row * $col;
                        $class = ($result % 2 == 0) ? 'even' : '';
                    ?>
                    <td class="<?= $class ?>"><?= $result ?></td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>