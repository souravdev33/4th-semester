if (isset($_POST['place_order'])) {
    $userID = $_SESSION['user_id']; // Assuming you have the user ID in session
    $totalAmount = $total;

    // Insert order into orders table
    $stmt = $conn->prepare("INSERT INTO orders (UserID, TotalAmount) VALUES (?, ?)");
    $stmt->bind_param("id", $userID, $totalAmount);
    $stmt->execute();
    $orderID = $stmt->insert_id;
    $stmt->close();

    // Insert order details into order_details table
    foreach ($_SESSION['cart'] as $productID => $productDetails) {
        $quantity = $productDetails['quantity'];
        $price = $productDetails['price'];
        
        $stmt = $conn->prepare("INSERT INTO order_details (OrderID, ProductID, Quantity, Price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $orderID, $productID, $quantity, $price);
        $stmt->execute();
        $stmt->close();
    }

    // Clear the cart
    unset($_SESSION['cart']);
    $orderPlaced = true;
}
