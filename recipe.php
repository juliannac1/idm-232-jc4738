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
  <link rel="stylesheet" href="normal.css">
  <title>Recipe</title>
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

    <main class="recipe-text">
    <button class="back-btn" onclick="history.back()">← Back</button>
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
<?php 
    $step_number = 1;
    $recipe_steps = explode("*", $recipe_recipe);

    $word_numbers = ['one','two','three','four','five','six'];

    foreach ($recipe_steps as $step) {

        
        $current_image = rtrim($images, '/') . '/' . $word_numbers[$step_number - 1] . '.jpg';
?>
    <div class="recipe-information-left">
        <div class="recipe-heading">
            <h3><?php echo htmlspecialchars($step_number); ?></h3>
        </div>

        <div class="recipe-steps">
            <p><?php echo htmlspecialchars(trim($step)); ?></p>
        </div>
    </div>

    <div class="recipe-information-right">
        <div class="recipe-img">
            <img src="<?php echo htmlspecialchars($current_image); ?>" 
                 alt="Step <?php echo $step_number; ?> image">
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