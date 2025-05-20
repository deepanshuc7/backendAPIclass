<?php

$dateString = "10:35:25 pm 21 January 1904";

$timestamp = strtotime($dateString);

$formattedDate = date("j F Y, h:i:s a", $timestamp);

$monthsHindi = [
    "January" => "जनवरी",
    "February" => "फ़रवरी",
    "March" => "मार्च",
    "April" => "अप्रैल",
    "May" => "मई",
    "June" => "जून",
    "July" => "जुलाई",
    "August" => "अगस्त",
    "September" => "सितंबर",
    "October" => "अक्टूबर",
    "November" => "नवंबर",
    "December" => "दिसंबर"
];

$ampmHindi = [
    "am" => "पूर्वाह्न",
    "pm" => "अपराह्न"
];

$day = date("j", $timestamp);
$month = $monthsHindi[date("F", $timestamp)];
$year = date("Y", $timestamp);
$time = date("h:i:s", $timestamp);
$ampm = $ampmHindi[date("a", $timestamp)];

$finalHindiDate = "$day $month $year, $time $ampm";
?>

<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <title>Hindi Date Display</title>
</head>
<body>
    <h2>English Format</h2>
    <p><strong>Timestamp:</strong> <?= $timestamp ?></p>
    <p><strong>Formatted Date:</strong> <?= $formattedDate ?></p>

    <h2>हिंदी में दिनांक</h2>
    <p><strong>Hindi Date Format:</strong> <?= $finalHindiDate ?></p>
</body>
</html>
