<?php
include'config.php';

if (isset($_GET['id'])) {
    $productID = intval($_GET['id']);
    $sql = "DELETE FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
}
?>
