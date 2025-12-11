

<?php

require_once '_db.php';



$stmt=$connection->prepare ("SELECT * FROM recipes");

$stmt->execute();

$result = $stmt->get_result();

$connection->close();


?>

<!DOCTYPE html>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="normal.css">
  <title>Home</title>
</head>

<body>
  
    <header>
    <input type="checkbox" id="nav-toggle" class="nav-toggle" hidden />
                <label for="nav-toggle" class="nav-toggle-label">
                  <span></span>
                  <span></span>
                  <span></span>
                </label>
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

      
    <div class="search-container">
  <div class="search-bar">
    <form method="POST" action="searchResult.php">
        <input type="search" name="search-bar" placeholder="Search for recipes">
        <button type="submit" class="search-btn">
            <img src="images/search.png" alt="Search" class="search-icon">
        </button>
    </form>
  </div>
  <button class="filter-button" id="filterBtn">Filter</button>
</div>
  <!-- Popup -->
  <div class="popup" id="filterPopup">
    <div class="popup-content">
      <button class="close-button" id="closePopup">&times;</button>
      <h2>Filters</h2>
      <div class="filter-options-container">
       <form action="filter.php" method="post">
       <div class="filter-options-container">
        <label><input type="checkbox" name="filters[]" value="egg"> No Egg</label>
        <label><input type="checkbox" name="filters[]" value="dairy"> No Milk</label>
        <label><input type="checkbox" name="filters[]" value="meat"> No Meat</label>
        <label><input type="checkbox" name="filters[]" value="nut"> No Nuts</label>
        <label><input type="checkbox" name="filters[]" value="gluten"> Gluten Free</label>
      </div>
      <button type="submit" class="apply-btn">Apply Filters</button>
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
                <p>with <?php echo $row['subheading']; ?></p>
            </div>
        </a>

    <?php endwhile; ?>
</div>
</body>
</html>
<script src="script.js"></script>

</body>