

<?php

require_once 'db.php';



$stmt=$connection->prepare ("SELECT * FROM recipes");

$stmt->execute();

$result = $stmt->get_result();


?>

<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="normalize" href="normal.css">
  <title>Home</title>
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

      
      
    <div class="search-bar">
      <form>
      <input type="search" placeholder="Search for recipes">
      <button type="submit" class="search-btn">
        <img src="images/search.png" alt="Search" class="search-icon">
      </button>
      </form>
  </div>
    <button class="filter-button" id="filterBtn">Filter</button>

  <!-- Popup -->
  <div class="popup" id="filterPopup">
    <div class="popup-content">
      <button class="close-button" id="closePopup">&times;</button>
      <h2>Filters</h2>
      <div class="filter-options-container">
       <form action="filter.php" method="post">
       <label><input type="checkbox" class="filter-checkbox"> No Meat</label>
        <label><input type="checkbox" class="filter-checkbox"> Eggless</label>
        <label><input type="checkbox" class="filter-checkbox"> No Dairy</label>
        <label><input type="checkbox" class="filter-checkbox"> No Nuts</label>
        <label><input type="checkbox" class="filter-checkbox"> Gluten Free</label>
       </form>
        
      </div>
    </div>
  </div>
  
  
  <div class="recipes">
    <?php while ($row = $result->fetch_assoc()) : ?>
    
        <a class="recipe-card" href="recipe.php?id=<?php echo $row['id']; ?>">
        
    <div class="recipe-cover-img">
        <img src="<?php echo rtrim($row['images'], '/') . '/cover.jpg'; ?>" 
             alt="<?php echo "Cover image for " . $row['title']; ?>">
    </div>


        
        <div class="card-header">
                <h2><?php echo $row['title']; ?></h2>
            </div>

            <div class="card-body">
                <p><?php echo $row['subheading']; ?></p>
            </div>
        </a>

    <?php endwhile; ?>
</div>
</body>
</html>

</body>