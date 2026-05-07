<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopZone - Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <style>
    .header-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 100px 0;
      text-align: center;
    }
    .header-section h1 { font-size: 3rem; font-weight: bold; }
    .header-section p { font-size: 1.3rem; opacity: 0.9; }
    .navbar-brand { font-size: 1.5rem; font-weight: bold; }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">🛒 ShopZone</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="products.php">All Products</a></li>
      <li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>
      <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<!-- Header -->
<div class="header-section">
  <div class="container">
    <h1>🛍️ Welcome to Our Store!</h1>
    <p>Find the best products at unbeatable prices</p>
    <?php if (isset($_SESSION['user'])): ?>
      <p class="mt-3">👋 Hello, <strong><?php echo htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']); ?></strong>!</p>
    <?php endif; ?>
    <a href="products.php" class="btn btn-light btn-lg mt-3">Shop Now</a>
  </div>
</div>

<!-- Features -->
<div class="container my-5">
  <div class="row text-center">
    <div class="col-md-4">
      <h2>🚚</h2>
      <h5>Free Shipping</h5>
      <p class="text-muted">On all orders over $50</p>
    </div>
    <div class="col-md-4">
      <h2>🔒</h2>
      <h5>Secure Payment</h5>
      <p class="text-muted">100% secure transactions</p>
    </div>
    <div class="col-md-4">
      <h2>↩️</h2>
      <h5>Easy Returns</h5>
      <p class="text-muted">30-day return policy</p>
    </div>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">&copy; 2024 ShopZone. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
