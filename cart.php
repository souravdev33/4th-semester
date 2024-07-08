<?php
// Start the session
session_start();

// Include the database configuration
include 'config.php';

// Handle removing a product from the cart
if (isset($_GET['remove'])) {
    $productID = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$productID])) {
        unset($_SESSION['cart'][$productID]);
    }
}

// Handle updating product quantities
if (isset($_POST['update_quantity'])) {
    foreach ($_POST['quantities'] as $productID => $quantity) {
        if (isset($_SESSION['cart'][$productID])) {
            $_SESSION['cart'][$productID]['quantity'] = max(1, intval($quantity));
        }
    }
}

// Handle placing an order
if (isset($_POST['place_order'])) {
    // Place order logic (save order to database, etc.)
    // Clear the cart
    unset($_SESSION['cart']);
    $orderPlaced = true;
}

// Include header
include 'header.php';
?>

<div class="container mt-4">
    <h2>Shopping Cart</h2>
    <?php if (isset($orderPlaced) && $orderPlaced): ?>
        <p class="alert alert-success">Your order has been placed successfully!</p>
    <?php endif; ?>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <form method="post" action="cart.php">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $productID => $productDetails) {
                        $subtotal = $productDetails['price'] * $productDetails['quantity'];
                        $total += $subtotal;
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($productDetails['name']) . '</td>';
                        echo '<td>$' . htmlspecialchars($productDetails['price']) . '</td>';
                        echo '<td>
                            <input type="number" name="quantities[' . $productID . ']" value="' . htmlspecialchars($productDetails['quantity']) . '" min="1" class="form-control" style="width: 60px;">
                            </td>';
                        echo '<td>$' . htmlspecialchars($subtotal) . '</td>';
                        echo '<td>
                            <a href="cart.php?remove=' . $productID . '" class="btn btn-danger btn-sm">Remove</a>
                            </td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><strong>$<?php echo $total; ?></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" name="update_quantity" class="btn btn-primary">Update Quantities</button>
            <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<?php
// Include footer
include 'footer.php';
?>