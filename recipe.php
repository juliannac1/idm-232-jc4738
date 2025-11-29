<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $connection->prepare("SELECT * FROM recipes WHERE id = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();

$recipe = $result->fetch_assoc();

$recipe_title = $recipe['title'];
$recipe_subheading = $recipe['subheading'];
$recipe_filters = $recipe['filter'];
$recipe_description = $recipe['bio'];
$recipe_ingredients = $recipe['ingredients'];
$recipe_tool = $recipe['tools'];
$recipe_recipe = $recipe['recipe'];
$images = $recipe['images'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="normalize" href="normal.css">
  <title>Recipe</title>
</head>

<body>
<header>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">All Recipes</a></li>
                <li><a href="help.html">Help</a></li>
                <li><a href="index.php"><h1>Savor.</h1></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="recipe-hero">
            <div class="recipe-hero-left">
                <div class="recipe-title">
                    <h1><?php echo htmlspecialchars($recipe_title)?></h1>
                </div>
                <div class="recipe-subtitle">
                    <h3><?php echo "w/ " . htmlspecialchars($recipe_subheading)?></h3>
                </div>
                <div class="recipe-description">
                    <p><?php echo htmlspecialchars($recipe_description)?></p>
                </div>
            </div>
            <div class="recipe-hero-right">
                <div class="recipe-cover-img">
                <img src="<?php echo rtrim($images, '/') . '/cover.jpg'; ?>" 
                alt="<?php echo "Cover image for " . htmlspecialchars($recipe_title); ?>">
                </div>
            </div>
        </section>

        <section class="recipe-containers">
            <div class="recipe-information-left">
                <div class="recipe-heading">
                    <h2>Ingredients</h2>
                </div>
                <div class="recipe-ingredients-list">
                    <ul>
                    <?php 
                        $ingredients = explode("\n", $recipe_ingredients);
                        foreach ($ingredients as $item) {
                            echo "<li>$item</li>";
                            
                        }
                    ?>
                    </ul>
                </div>
            </div>
        <div class="recipe-ingredients-img">
            <div class="recipe-img">
                <img src="<?php echo rtrim($images, '/') . '/ingredients.png'; ?>" 
                    alt="<?php echo "Ingredients for " . htmlspecialchars($recipe_title); ?>">
            </div>
        </div>

        </section>    
        <section>
            <h1>Steps</h1>
        </section>       
        <section class="recipe-containers">
    <?php 
        $step_number = 1;
        $recipe_steps = explode("*", $recipe_recipe);

        // Convert the DB column 'images' into an array
        $image_list = explode(",", $images); // e.g., "one.jpg,two.jpg,three.jpg"

        foreach ($recipe_steps as $step) {
            // Get the image for this step (array is 0-indexed)
            $current_image = isset($image_list[$step_number - 1]) ? $image_list[$step_number - 1] : null;
    ?>
        <div class="recipe-information-left">
            <div class="recipe-heading">
                <h3><?php echo htmlspecialchars($step_number); ?></h3>
            </div>

            <div class="recipe-steps">
                <p><?php echo htmlspecialchars($step); ?></p>
            </div>
        </div>

        <div class="recipe-information-right">
            <div class="recipe-img">
                <?php if ($current_image): ?>
                    <img src="uploads/<?php echo htmlspecialchars($current_image); ?>" 
                         alt="Step <?php echo $step_number; ?> image">
                <?php endif; ?>
            </div>
        </div>

            <?php
                $step_number++;
                }
            ?>
            </section>

        <section class="recipe-conclusion">
            <h3>Fresh and delicious, savor it while it lasts.</h3>
        </section>
    </main>
</body>
</html>