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

<div class="container mt-4">
    <!-- Categories and Banner Slider -->
    <div class="row">
        <!-- Categories -->
        <div class="col-md-4">
            <?php include 'categories.php'; ?>
        </div>

        <!-- Banner Slider -->
        <div class="col-md-8">
            <!-- Add your slider code here -->
            <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/frontend/img/carousel/01.jpg" class="d-block w-100" alt="Banner 1">
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/img/carousel/02.jpg" class="d-block w-100" alt="Banner 2">
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/img/carousel/03.jpg" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/img/carousel/04.jpg" class="d-block w-100" alt="Banner 3">
                    </div>
                    <div class="carousel-item">
                        <img src="/frontend/img/carousel/05.jpg" class="d-block w-100" alt="Banner 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#bannerCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#bannerCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <br>
    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-12">
            <form action="index.php" method="GET" class='form-inline'>
                <input class="form-control mr-sm-2" type="search" placeholder="Search for products" aria-label="Search" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <!-- Products Showcase -->
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

<?php
// Include footer
include 'footer.php';
?>