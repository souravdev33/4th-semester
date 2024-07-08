<?php
// Include the database configuration
include 'config.php';

// Fetch categories from the database
$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<ul class="list-group">';
    while($row = $result->fetch_assoc()) {
        echo '<li class="list-group-item"><a href="category.php?id=' . $row['CategoryID'] . '">' . $row['CategoryName'] . '</a></li>';
    }
    echo '</ul>';
} else {
    echo "No categories found.";
}
?> 

