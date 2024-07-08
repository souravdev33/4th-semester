<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            height: 100vh;
            background-color: #f8f9fa;
            padding: 15px;
        }
        .sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #e2e6ea;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
        }
        .status.active { background-color: #28a745; }
        .status.draft { background-color: #ffc107; }
        .status.scheduled { background-color: #17a2b8; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <h2>x10sion</h2>
            <a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="products.php"><i class="fas fa-box"></i> Products</a>
            <a href="categories.php"><i class="fas fa-tags"></i> Categories</a>
            <a href="sales.php"><i class="fas fa-shopping-cart"></i> Sales</a>
            <a href="customers.php"><i class="fas fa-users"></i> Customers</a>
            <a href="analytics.php"><i class="fas fa-chart-line"></i> Analytics</a>
            <a href="notifications.php"><i class="fas fa-bell"></i> Notifications</a>
            <a href="settings.php"><i class="fas fa-cog"></i> Settings</a>
        </div>
        <div class="container mt-4">
            <h1>Products</h1>
            <a href="add_product.php" class="btn btn-primary mb-3">Add New Product</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "ecommerce";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT p.ProductID, p.Name, p.Price, p.Stock, p.Image, c.CategoryName, p.Description
                            FROM products p
                            JOIN categories c ON p.CategoryID = c.CategoryID";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['Description']);
                        echo '<tr>';
                        echo '<td><img src="images/' . $row['Image'] . '" class="product-img" alt="Product Image"> ' . $row['Name'] . '</td>';
                        echo '<td>' . $row['CategoryName'] . '</td>';
                        echo '<td>$' . number_format($row['Price'], 2) . '</td>';
                        echo '<td>' . $row['Stock'] . '</td>';
                        echo '<td><span class="status ' . $statusClass . '">' . ucfirst($row['Description']) . '</span></td>';
                        echo '<td><a href="edit_product.php?id=' . $row['ProductID'] . '" class="btn btn-sm btn-info">Edit</a> <a href="delete_product.php?id=' . $row['ProductID'] . '" class="btn btn-sm btn-danger">Delete</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


