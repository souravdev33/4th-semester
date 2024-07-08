<?php
// Start the session
session_start();

// Include the database configuration
include 'config.php';

// Initialize variables
$searchQuery = '';
$products = [];

// Check if there's a search query
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    // Fetch products based on the search query
    $sql = "SELECT * FROM products WHERE Name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $searchQuery . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    // Fetch all products
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}


// Include header
include 'header.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Prodcut</title>
  </head>
  <body>
    
<!-- Products Showcase -->
<div class="container mt-4">
    <div class="row">
            <div class="col-12">
                <h2><?php echo $searchQuery ? 'Search Results for "' . htmlspecialchars($searchQuery) . '"' : 'All Products'; ?></h2>
                <div class="row">
                    <?php
                    if (!empty($products)) {
                        foreach ($products as $product) {
                            echo '<div class="col-md-4 mb-4">';
                            echo '<div class="card">';
                            echo '<img src="images/'. htmlspecialchars($product['Image']) . '" class="card-img-top" alt="' . htmlspecialchars($product['Name']) . '">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($product['Name']) . '</h5>';
                            echo '<p class="card-text">$' . htmlspecialchars($product['Price']) . '</p>';
                            echo '<a href="product.php?id=' . $product['ProductID'] . '" class="btn btn-primary">View Details</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No products found.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
