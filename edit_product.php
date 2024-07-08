<?php
include'config.php';
if (isset($_GET['id'])) {
    $productID = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE ProductID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

if (isset($_POST['update_product'])) {
    $productID = intval($_POST['ProductID']);
    $name = $_POST['Name'];
    $price = floatval($_POST['Price']);
    $stock = intval($_POST['Stock']);
    $categoryID = intval($_POST['CategoryID']);
    $description = $_POST['Description'];

    $sql = "UPDATE products SET Name=?, Price=?, Stock=?, CategoryID=?, Description=? WHERE ProductID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdissi", $name, $price, $stock, $categoryID, $description, $productID);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Edit Product</h1>
    <form method="post">
        <input type="hidden" name="ProductID" value="<?php echo $product['ProductID']; ?>">
        <div class="form-group">
            <label for="Name">Product Name</label>
            <input type="text" class="form-control" id="Name" name="Name" value="<?php echo $product['Name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Price">Price</label>
            <input type="text" class="form-control" id="Price" name="Price" value="<?php echo $product['Price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Stock">Stock</label>
            <input type="number" class="form-control" id="Stock" name="Stock" value="<?php echo $product['Stock']; ?>" required>
        </div>
        <div class="form-group">
            <label for="CategoryID">Category</label>
            <input type="number" class="form-control" id="CategoryID" name="CategoryID" value="<?php echo $product['CategoryID']; ?>" required>
        </div>
        <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" id="Description" name="Description" required><?php echo $product['Description']; ?></textarea>
        </div>
        <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
    </form>
</div>
</body>
</html>
