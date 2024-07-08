<?php
// Include the database configuration
include 'config.php';

// Get the order ID from the query string
$orderID = intval($_GET['id']);

// Fetch the order details
$sql = "SELECT od.*, p.Name as ProductName
        FROM order_details od
        JOIN products p ON od.ProductID = p.ProductID
        WHERE od.OrderID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();
$orderDetails = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Include header
include 'header.php';
?>

<div class="container mt-4">
    <h2>Order Details</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalAmount = 0;
            foreach ($orderDetails as $detail) {
                $subtotal = $detail['Quantity'] * $detail['Price'];
                $totalAmount += $subtotal;
                echo '<tr>';
                echo '<td>' . $detail['ProductName'] . '</td>';
                echo '<td>' . $detail['Quantity'] . '</td>';
                echo '<td>$' . number_format($detail['Price'], 2) . '</td>';
                echo '<td>$' . number_format($subtotal, 2) . '</td>';
                echo '</tr>';
            }
            ?>
            <tr>
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><strong>$<?php echo number_format($totalAmount, 2); ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>

<?php

?>
