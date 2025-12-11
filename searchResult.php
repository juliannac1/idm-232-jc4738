<?php
include '_db.php';

$search_input = '';
$result = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $search_input = trim($_POST['search-bar'] ?? '');

    if (!empty($search_input)) {
        $search = '%' . $search_input . '%';

        $stmt = $connection->prepare("
            SELECT * FROM recipes
            WHERE title LIKE ?
            OR subheading LIKE ?
            OR bio LIKE ?
            OR ingredients LIKE ?
            OR recipe LIKE ?
        ");

        $stmt->bind_param("sssss", $search, $search, $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $error_message = "Please enter a search term.";
    }
} else {
    $error_message = "Please submit a search from the homepage.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="normalize" href="normal.css">
  <title>Search Results</title>
</head>
<body>
<header>
<nav>
        <ul class="nav-links">
        <li class="savor"><a href="index.php"><h1>Savor.</h1></a></li>
        <div class="nav">
            <li><a href="index.php">Recipes</a></li>
            <li><a href="help.html">Help</a></li>
        </div>
        </ul>
        </nav>
</header>

<main>
<button class="back-btn" onclick="history.back()">← Back</button>

    <?php if (!empty($error_message)): ?>
        <p><?php echo htmlspecialchars($error_message); ?></p>
    <?php elseif ($result && $result->num_rows > 0): ?>
        <div class="result-wrapper">
        <h2>Search results for "<?php echo htmlspecialchars($search_input); ?>"</h2>
        <div class="recipes">
            <?php while ($row = $result->fetch_assoc()): ?>
                <a class="recipe-card" href="recipe.php?id=<?php echo $row['id']; ?>">
                    <div class="recipe-cover-img">
                        <img src="<?php echo rtrim($row['images'], '/') . '/cover.jpg'; ?>" 
                             alt="<?php echo "Cover image for " . htmlspecialchars($row['title']); ?>">
                    </div>
                    <div class="card-header">
                        <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    </div>
                    <div class="card-body">
                        <p><?php echo htmlspecialchars($row['subheading']); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No recipes found for "<?php echo htmlspecialchars($search_input); ?>"</p>
    <?php endif; ?>
    </div>
</main>
</body>
</html>
