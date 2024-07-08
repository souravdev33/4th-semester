<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>E-commerce</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="path/to/logo.png" width="30" height="30" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../frontend/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../frontend/product_showcase.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../frontend/contact.php">Contact</a>
                </li>
            </ul>
            <div class="navbar-nav">
                <?php if (isset($_SESSION['customer_logged_in']) && $_SESSION['customer_logged_in']) : ?>
                    <a class="nav-link" href="profile.php">
                        <img src="path/to/avatar.png" width="30" height="30" class="rounded-circle" alt="User Avatar">
                    </a>
                    <a class="nav-link" href="logout.php">Logout</a>
                <?php else : ?>
                    <a class="nav-link" href="login.php">Login</a>
                    <a class="nav-link" href="signup.php">Sign Up</a>
                <?php endif; ?>
                <a class="nav-link" href="cart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge badge-pill badge-danger">
                        <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>
    
   