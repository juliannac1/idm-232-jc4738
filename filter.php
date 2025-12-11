<?php
include '_db.php';

$conditions = [];
$params = [];
$param_types = '';

if (!empty($_POST['filters'])) {
    foreach ($_POST['filters'] as $filter) {
        
        $conditions[] = "filter LIKE ?";
        $params[] = "%$filter%";
        $param_types .= 's';
    }
}

$sql = empty($conditions) ? 
    "SELECT * FROM recipes" : 
    "SELECT * FROM recipes WHERE " . implode(" AND ", $conditions);

$stmt = $connection->prepare($sql);

if (!empty($conditions)) {
    $stmt->bind_param($param_types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filtered Recipes</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normal.css">
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
<hr>

<div class="result-wrapper">
    <h2 class="Filtered">Filtered Recipes</h2>

    <div class="recipes">
      <?php if ($result->num_rows > 0): ?>
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
      <?php else: ?>
        <p>No recipes found with the selected filters.</p>
      <?php endif; ?>
    </div>
</div>

</main>

</body>
</html>
