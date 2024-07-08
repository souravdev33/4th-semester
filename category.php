<?php
// Start the session
session_start();

// Include the database configuration
include 'config.php';

// Get the category ID from the URL
$categoryID = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch category name
$sql = "SELECT CategoryName FROM categories WHERE CategoryID = $categoryID";
$result = $conn->query($sql);
$categoryName = $result->num_rows > 0 ? $result->fetch_assoc()['CategoryName'] : '';

// Fetch products from the database based on the category ID
$sql = "SELECT * FROM products WHERE CategoryID = $categoryID";
$result = $conn->query($sql);

// Include header
include 'header.php';
?>

<div class="container mt-4">
    <h2><?php echo htmlspecialchars($categoryName); ?></h2>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img src="images/' . $row['Image'] . '" class="card-img-top" alt="' . htmlspecialchars($row['Name']) . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($row['Name']) . '</h5>';
                echo '<p class="card-text">$' . htmlspecialchars($row['Price']) . '</p>';
                echo '<a href="product.php?id=' . $row['ProductID'] . '" class="btn btn-primary">View Details</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No products found in this category.</p>';
        }
        ?>
    </div>
</div>

<?php
// Include footer
include 'footer.php';
?>

