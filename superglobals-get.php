<?php
$articles = [
    [
        'title' => '2025 Suzuki DR-Z4S Review',
        'date' => 'May 15, 2025',
        'content' => "There are three basic classes within the dual sport segment. Lightweights such as Honda’s CRF300L and Kawasaki’s KLX300. High-performance, competition-spec dual sports from KTM, Husqvarna, and Beta. And heavyweights. Classic air-cooled thumpers such as the Honda XR650L and Suzuki DR650S. But where did the DR-Z400S fit in? You might say everywhere and nowhere.

The DR-Z400 has been in a class of its own for a long time. And that is what has made it such a successful dual sport. It’s bigger and more capable than the lightweights, but with better road manners and lower maintenance than high-performance dual sports. Suzuki found a niche that needed filling, leaned in, and has done exceptionally well for a very long time. For riders who want a true 50/50 dual sport with respectable off-road performance, the DR-Z400S has always been the choice.

I should know, I own one. But after 25 years of being essentially unchanged, what drove Suzuki to develop an all-new DR-Z? Was Suzuki losing sales to buyers who value more modern styling, fuel injection, and rider aids? Or was it tightening emission standards that led to the new DR-Z4S? Of course it was both, but mostly the latter.",
        'image' => 'images/suzuki.png',
        'imageDescription' => "Suzuki’s new DR-Z4S is sporty off-road and comfortable on the pavement, striking the perfect balance of an everyday dual sport."
    ],
    [
        'title' => 'Ducati Developing Sportbike Auto-Clutch',
        'date' => 'May 19, 2025',
        'content' => "Automatic and semi-automatic transmissions have been a hotbed of development in recent years with the likes of Yamaha, KTM, and BMW joining longtime proponent Honda in launching mainstream models fitted with self-shifters.

That list of manufacturers doesn’t include one of the most tech-heavy bike companies of all, Ducati, but in the near future the Italian brand looks set to join the fray with its own take on the technology.

A brace of patent applications filed by Ducati reveal that the firm’s engineers are working on a halfway-house toward a full or semi-automatic gearshift, with a system that automates the operation of the clutch while leaving it down to the rider to swap cogs conventionally using a foot lever.

Ducati’s system is closer to the Honda E-Clutch than to its Italian rival MV Agusta’s SCS. It uses a computer-control unit and an electromechanical actuator to work in parallel with the conventional clutch lever, allowing the choice of a manual or auto-clutch mode, while always leaving a manual override. However, it operates quite differently to the Honda design, as Ducati’s auto-clutch is hydraulically controlled rather than cable-operated.",
        'image' => 'images/ducati.png',
        'imageDescription' => "Will future Ducati sportbikes offer an automated clutch similar to Honda’s E-Clutch?"
    ],
    [
        'title' => 'Kawasaki Hydrogen Bike Hurdles',
        'date' => 'May 16, 2025',
        'content' => "Hydrogen-fueled engines promise fast refueling and nearly zero emissions, but there are major hurdles. Hydrogen is difficult to store and transport, and leaks are hard to detect.

A Kawasaki patent gives a glimpse at the challenges in packaging hydrogen systems on motorcycles compared to cars. The external proportions already hint at difficulties, but the internal structure reveals even more challenges.",
        'image' => 'images/kawasaki.png',
        'imageDescription' => 'Packaging is the issue with a motorcycle compared to an automobile.'
    ]
];

$searchTerm = $_GET['search'] ?? '';
$filteredArticles = [];

if ($searchTerm !== '') {
    foreach ($articles as $index => $article) {
        if (stripos($article['content'], $searchTerm) !== false) {
            $filteredArticles[$index] = $article;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php
        if (isset($_GET['id']) && isset($articles[$_GET['id']])) {
            echo htmlspecialchars($articles[$_GET['id']]['title']);
        } else {
            echo "Today's Newspaper";
        }
        ?>
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .article {
            background: white;
            padding: 20px;
            margin: 20px auto;
            border-radius: 10px;
            max-width: 800px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .article img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .search-form {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-form input[type="text"] {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-form button {
            padding: 10px 20px;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .read-more {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .read-more:hover {
            background-color: #1e7e34;
        }

        .no-results {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>

    <h1><a href="superglobals-get.php" style="text-decoration: none; color: inherit;">Today's Newspaper</a></h1>


    <div class="search-form">
        <form method="get">
            <input type="text" name="search" value="<?= htmlspecialchars($searchTerm) ?>"
                placeholder="Search articles...">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if (isset($articles[$id])) {
            $article = $articles[$id];
            echo "<div class='article'>";
            echo "<h2>{$article['title']}</h2>";
            echo "<p><em>{$article['date']}</em></p>";
            echo "<img src='{$article['image']}' alt='{$article['imageDescription']}'><br>";
            echo "<p>{$article['content']}</p>";
            echo "</div>";
        } else {
            echo "<p class='no-results'>This article does not exist.</p>";
        }
    } elseif ($searchTerm !== '') {
        if (!empty($filteredArticles)) {
            foreach ($filteredArticles as $index => $article) {
                echo "<div class='article'>";
                echo "<h2>{$article['title']}</h2>";
                echo "<p><em>{$article['date']}</em></p>";
                echo "<img src='{$article['image']}' alt='{$article['imageDescription']}'><br>";
                echo "<p>" . substr($article['content'], 0, 150) . "...</p>";
                echo "<a class='read-more' href='?id=$index'>Read more</a>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-results'>No articles matched: '" . htmlspecialchars($searchTerm) . "'</p>";
        }
    } else {
        foreach ($articles as $index => $article) {
            echo "<div class='article'>";
            echo "<h2>{$article['title']}</h2>";
            echo "<p><em>{$article['date']}</em></p>";
            echo "<img src='{$article['image']}' alt='{$article['imageDescription']}'><br>";
            echo "<p>" . substr($article['content'], 0, 150) . "...</p>";
            echo "<a class='read-more' href='?id=$index'>Read more</a>";
            echo "</div>";
        }
    }
    ?>

</body>

</html>