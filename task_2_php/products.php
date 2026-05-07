<?php
session_start();

$products = [
  'Laptop Pro X' => [
    'price' => '15999',
    'img'   => 'img\download (1).jfif',
    'desc'  => 'High-performance laptop with Intel i7, 16GB RAM, 512GB SSD.'
  ],
  'Wireless Headphones' => [
    'price' => '1299',
    'img'   => 'img\shopping.avif',
    'desc'  => 'Premium noise-cancelling headphones with 30hr battery life.'
  ],
  'Smartphone Z12' => [
    'price' => '8500',
    'img'   => 'img\download.jfif',
    'desc'  => '6.5" AMOLED display, 5G ready, 108MP camera system.'
  ],
  'Smart Watch' => [
    'price' => '2200',
    'img'   => 'img\download.avif',
    'desc'  => 'Fitness tracker with heart rate monitor and GPS.'
  ],
  'Running Shoes' => [
    'price' => '620',
    'img'   => 'img\download (2).jfif' ,
    'desc'  => 'Lightweight and breathable shoes for everyday comfort.'
  ],
  'Leather Bag' => [
    'price' => '950',
    'img'   => 'img\shopping (1).avif',
    'desc'  => 'Stylish genuine leather bag with multiple compartments.'
  ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopZone - All Products</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <style>
    .navbar-brand { font-size: 1.5rem; font-weight: bold; }
    .card { transition: transform 0.2s; height: 100%; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
    .card-img-top { height: 180px; object-fit: cover; }
    .badge-price { font-size: 1rem; }
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
      <li class="nav-item active"><a class="nav-link" href="products.php">All Products</a></li>
      <li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>
      <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<div class="container my-5">
  <h2 class="mb-4 text-center">🛍️ All Products</h2>
  <div class="row">
    <?php foreach ($products as $product => $values): ?>
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="<?php echo htmlspecialchars($values['img']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product); ?>">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?php echo htmlspecialchars($product); ?></h5>
          <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars($values['desc']); ?></p>
          <div class="d-flex justify-content-between align-items-center mt-2">
            <span class="badge badge-success badge-price p-2">EGP <?php echo htmlspecialchars($values['price']); ?></span>
            <button class="btn btn-primary btn-sm">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<footer class="bg-dark text-white text-center py-3">
  <p class="mb-0">&copy; 2024 ShopZone. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
