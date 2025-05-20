<?php
// Autoloader to load classes dynamically
spl_autoload_register(function ($class) {
    require_once __DIR__ . '/classes/' . $class . '.php';
});

// Instantiate the Percent class
$percent = new Percent(150, 100);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Percentage Calculator</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { border-collapse: collapse; width: 400px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>

<h2>What percentage is 150 of 100?</h2>

<table>
    <tr>
        <th>Absolute</th>
        <td><?= $percent->absolute ?></td>
    </tr>
    <tr>
        <th>Relative</th>
        <td><?= $percent->relative ?></td>
    </tr>
    <tr>
        <th>Whole number</th>
        <td><?= $percent->hundred ?>%</td>
    </tr>
    <tr>
        <th>Nominal</th>
        <td><?= $percent->nominal ?></td>
    </tr>
</table>

</body>
</html>
