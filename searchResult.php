
<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="normalize" href="normal.css">
  <title>Results</title>
</head>
<?php

include 'db.php';

// Get ID safely
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    die("No ID provided.");
}

// Example: you can use $id from GET, or a default $min_id
$min_id = (int)$id;

$stmt = $connection->prepare("SELECT * FROM recipes WHERE id=?");
$stmt->bind_param('i', $min_id); // 'i' = integer
$stmt->execute();

$result = $stmt->get_result();

// Optional: get search query safely
$search_query = isset($_GET['query']) ? $_GET['query'] : '';



                if (isset($result) && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $recipe_link = "recipe.php?id=" . $row['id'];
                   
                ?>
                        
                        <div class="recipe-card">
                            <a href="<?php echo $recipe_link; ?>">
                                <div class="recipe-img">
                                <div class="recipe-cover-img">
                                    <img src="<?php echo rtrim($row['images'], '/') . '/cover.jpg'; ?>" 
                                        alt="<?php echo "Cover image for " . $row['title']; ?>">
                            
                                </div>
                                <div class="recipe-name">
                                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                                </div>
                                <div class="recipe-description">
                                    <p><?php echo "w/ " . htmlspecialchars($row['subheading']); ?></p>
                                </div>
                            </a>
                        </div>

                    <?php
                          }
                      } else {
                          echo "<p>No recipes found.</p>";
                      }
                    ?> 