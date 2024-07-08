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
    <h2>Admin Dashboard</h2>
    <h3>Orders</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include'config.php';
            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['OrderID'] . '</td>';
                echo '<td>' . $row['CustomerID'] . '</td>';
                echo '<td>' . $row['OrderDate'] . '</td>';
                echo '<td>$' . number_format($row['TotalAmount'], 2) . '</td>';
                echo '<td><a href="order_details.php?id=' . $row['OrderID'] . '" class="btn btn-sm btn-info">View Details</a></td>';
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
