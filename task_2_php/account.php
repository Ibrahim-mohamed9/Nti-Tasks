<?php
session_start();

$loginErrors  = [];
$profileErrors = [];
$successMsg    = '';


// CASE 1: User NOT logged in → handle Login form submission
if (!isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {

  $email    = trim($_POST['email'] ?? '');
  $password = trim($_POST['password'] ?? '');

  // Validation
  if (empty($email)) {
    $loginErrors['email'] = 'Email is required.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $loginErrors['email'] = 'Please enter a valid email address.';
  }

  if (empty($password)) {
    $loginErrors['password'] = 'Password is required.';
  } elseif (strlen($password) < 6) {
    $loginErrors['password'] = 'Password must be at least 6 characters.';
  }

  // If no errors → store in session and redirect to all products
  if (empty($loginErrors)) {
    $_SESSION['user'] = ['email' => $email];
    header('Location: products.php');
    exit;
  }
}


// CASE 2: User IS logged in → handle Profile form submission
if (isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'profile') {

  $username  = trim($_POST['username']  ?? '');
  $password  = trim($_POST['password']  ?? '');
  $email     = trim($_POST['email']     ?? '');
  $phone     = trim($_POST['phone']     ?? '');
  $facebook  = trim($_POST['facebook']  ?? '');
  $twitter   = trim($_POST['twitter']   ?? '');
  $instagram = trim($_POST['instagram'] ?? '');

  // --- username ---
  if (empty($username)) {
    $profileErrors['username'] = 'Username is required.';
  } elseif (strlen($username) < 3) {
    $profileErrors['username'] = 'Username must be at least 3 characters.';
  } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    $profileErrors['username'] = 'Username can only contain letters, numbers, and underscores.';
  }

  // --- password ---
  if (empty($password)) {
    $profileErrors['password'] = 'Password is required.';
  } elseif (strlen($password) < 8) {
    $profileErrors['password'] = 'Password must be at least 8 characters.';
  } elseif (!preg_match('/[A-Z]/', $password)) {
    $profileErrors['password'] = 'Password must contain at least one uppercase letter.';
  } elseif (!preg_match('/[0-9]/', $password)) {
    $profileErrors['password'] = 'Password must contain at least one number.';
  }

  // --- email ---
  if (empty($email)) {
    $profileErrors['email'] = 'Email is required.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $profileErrors['email'] = 'Please enter a valid email address.';
  }

  // --- phone ---
  if (empty($phone)) {
    $profileErrors['phone'] = 'Phone number is required.';
  } elseif (!preg_match('/^[0-9]{10,15}$/', $phone)) {
    $profileErrors['phone'] = 'Phone number must be 10–15 digits only.';
  }

  // --- facebook ---
  if (empty($facebook)) {
    $profileErrors['facebook'] = 'Facebook URL is required.';
  } elseif (!filter_var($facebook, FILTER_VALIDATE_URL)) {
    $profileErrors['facebook'] = 'Please enter a valid Facebook URL (include https://).';
  } elseif (strpos($facebook, 'facebook.com') === false) {
    $profileErrors['facebook'] = 'URL must be a Facebook link (facebook.com).';
  }

  // --- twitter ---
  if (empty($twitter)) {
    $profileErrors['twitter'] = 'Twitter URL is required.';
  } elseif (!filter_var($twitter, FILTER_VALIDATE_URL)) {
    $profileErrors['twitter'] = 'Please enter a valid Twitter/X URL (include https://).';
  } elseif (strpos($twitter, 'twitter.com') === false && strpos($twitter, 'x.com') === false) {
    $profileErrors['twitter'] = 'URL must be a Twitter/X link (twitter.com or x.com).';
  }

  // --- instagram ---
  if (empty($instagram)) {
    $profileErrors['instagram'] = 'Instagram URL is required.';
  } elseif (!filter_var($instagram, FILTER_VALIDATE_URL)) {
    $profileErrors['instagram'] = 'Please enter a valid Instagram URL (include https://).';
  } elseif (strpos($instagram, 'instagram.com') === false) {
    $profileErrors['instagram'] = 'URL must be an Instagram link (instagram.com).';
  }

  // If no errors → save to session and redirect home
  if (empty($profileErrors)) {
    $_SESSION['user'] = array_merge($_SESSION['user'], [
      'username'  => $username,
      'email'     => $email,
      'phone'     => $phone,
      'facebook'  => $facebook,
      'twitter'   => $twitter,
      'instagram' => $instagram,
    ]);
    header('Location: index.php');
    exit;
  }
}

// Helper: show field error
function fieldError($errors, $field) {
  if (isset($errors[$field])) {
    echo '<div class="invalid-feedback d-block">' . htmlspecialchars($errors[$field]) . '</div>';
  }
}
function hasError($errors, $field) {
  return isset($errors[$field]) ? 'is-invalid' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShopZone - Account</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <style>
    .navbar-brand { font-size: 1.5rem; font-weight: bold; }
    .account-card { max-width: 550px; margin: 60px auto; }
    .form-icon { font-size: 2rem; }
  </style>
</head>
<body class="bg-light">

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
      <li class="nav-item active"><a class="nav-link" href="account.php">Account</a></li>
      <?php if (isset($_SESSION['user'])): ?>
        <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<div class="container">

  <?php if (!isset($_SESSION['user'])): ?>
  <!-- ===================== LOGIN FORM ===================== -->
  <div class="account-card">
    <div class="card shadow">
      <div class="card-body p-4">
        <div class="text-center mb-3">
          <span class="form-icon">🔐</span>
          <h3 class="mt-2">Login to Your Account</h3>
          <p class="text-muted">Enter your credentials to continue</p>
        </div>

        <form method="POST" action="account.php" novalidate>
          <input type="hidden" name="action" value="login">

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email Address</label>
            <input
              type="email"
              class="form-control <?php echo hasError($loginErrors, 'email'); ?>"
              id="email"
              name="email"
              placeholder="you@example.com"
              value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
            >
            <?php fieldError($loginErrors, 'email'); ?>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control <?php echo hasError($loginErrors, 'password'); ?>"
              id="password"
              name="password"
              placeholder="Enter your password"
            >
            <?php fieldError($loginErrors, 'password'); ?>
          </div>

          <button type="submit" class="btn btn-primary btn-block mt-3">Login</button>
        </form>
      </div>
    </div>
  </div>

  <?php else: ?>
  <!-- ===================== PROFILE FORM ===================== -->
  <div class="account-card" style="max-width:600px;">
    <div class="card shadow">
      <div class="card-body p-4">
        <div class="text-center mb-3">
          <span class="form-icon">👤</span>
          <h3 class="mt-2">Complete Your Profile</h3>
          <p class="text-muted">Fill in your details below</p>
        </div>

        <form method="POST" action="account.php" novalidate>
          <input type="hidden" name="action" value="profile">

          <!-- Username -->
          <div class="form-group">
            <label for="username">Username</label>
            <input
              type="text"
              class="form-control <?php echo hasError($profileErrors, 'username'); ?>"
              id="username"
              name="username"
              placeholder="e.g. john_doe"
              value="<?php echo htmlspecialchars($_POST['username'] ?? $_SESSION['user']['username'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'username'); ?>
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control <?php echo hasError($profileErrors, 'password'); ?>"
              id="password"
              name="password"
              placeholder="Min 8 chars, 1 uppercase, 1 number"
            >
            <?php fieldError($profileErrors, 'password'); ?>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email Address</label>
            <input
              type="email"
              class="form-control <?php echo hasError($profileErrors, 'email'); ?>"
              id="email"
              name="email"
              placeholder="you@example.com"
              value="<?php echo htmlspecialchars($_POST['email'] ?? $_SESSION['user']['email'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'email'); ?>
          </div>

          <!-- Phone -->
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input
              type="text"
              class="form-control <?php echo hasError($profileErrors, 'phone'); ?>"
              id="phone"
              name="phone"
              placeholder="e.g. 01012345678"
              value="<?php echo htmlspecialchars($_POST['phone'] ?? $_SESSION['user']['phone'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'phone'); ?>
          </div>

          <!-- Facebook -->
          <div class="form-group">
            <label for="facebook">Facebook Profile URL</label>
            <input
              type="url"
              class="form-control <?php echo hasError($profileErrors, 'facebook'); ?>"
              id="facebook"
              name="facebook"
              placeholder="https://facebook.com/yourprofile"
              value="<?php echo htmlspecialchars($_POST['facebook'] ?? $_SESSION['user']['facebook'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'facebook'); ?>
          </div>

          <!-- Twitter -->
          <div class="form-group">
            <label for="twitter">Twitter / X Profile URL</label>
            <input
              type="url"
              class="form-control <?php echo hasError($profileErrors, 'twitter'); ?>"
              id="twitter"
              name="twitter"
              placeholder="https://twitter.com/yourhandle"
              value="<?php echo htmlspecialchars($_POST['twitter'] ?? $_SESSION['user']['twitter'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'twitter'); ?>
          </div>

          <!-- Instagram -->
          <div class="form-group">
            <label for="instagram">Instagram Profile URL</label>
            <input
              type="url"
              class="form-control <?php echo hasError($profileErrors, 'instagram'); ?>"
              id="instagram"
              name="instagram"
              placeholder="https://instagram.com/yourhandle"
              value="<?php echo htmlspecialchars($_POST['instagram'] ?? $_SESSION['user']['instagram'] ?? ''); ?>"
            >
            <?php fieldError($profileErrors, 'instagram'); ?>
          </div>

          <button type="submit" class="btn btn-success btn-block mt-3">Save Profile</button>
        </form>
      </div>
    </div>
  </div>

  <?php endif; ?>

</div><!-- /container -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
