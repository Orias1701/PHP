<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Hub</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📚</text></svg>">
</head>
<body>
    <header>
        <h1><a href="index.php">Assignments</a></h1>
        <button id="theme-toggle">🌓</button>
    </header>
    <main>
        <div class="container">
            <?php
            // Đọc file JSON
            $jsonFile = 'projects.json';
            if (file_exists($jsonFile)) {
                $jsonData = file_get_contents($jsonFile);
                $projects = json_decode($jsonData, true);
                
                // Loop qua từng project và hiển thị card
                foreach ($projects as $project) {
                    echo '<div class="card">';
                    echo '    <div class="card-header">';
                    echo '        <h2>' . htmlspecialchars($project['name']) . '</h2>';
                    echo '    </div>';
                    echo '    <div class="card-body">';
                    echo '        <div class="btn-group">';
                    echo '            <a href="' . htmlspecialchars($project['url']) . '" target="_blank" class="btn">Mở tab mới</a>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<p>Không tìm thấy file projects.json.</p>';
            }
            ?>
        </div>
    </main>
    <footer>
        <p>Long's - No Framework - 100% static.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>