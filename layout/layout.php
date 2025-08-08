<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once BASE_PATH . '/utils/auth.util.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Determine current page (this should be set in index.php)
$page = $_GET['page'] ?? 'home';
$validPages = ['dashboard', 'home', 'users', 'cart', 'orders', 'profile'];

// Fallback page check
if (!in_array($page, $validPages)) {
    echo "<h2>🚫 Page not found</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AblePlay</title>
  <link rel="stylesheet" href="assets/css/global.css">
  <style>
    /* Optional basic fallback styling if CSS fails */
    body { font-family: sans-serif; margin: 0; padding: 1rem; }
    header, nav, main { margin-bottom: 1rem; }
    nav ul { list-style: none; padding: 0; display: flex; gap: 1rem; }
    nav a { text-decoration: none; color: blue; }
  </style>
</head>
<body>

  <header>
    <h1>🎮 AblePlay</h1>

    <nav>
      <ul>
        <li><a href="index.php?page=home">Home</a></li>
        <li><a href="index.php?page=dashboard">Dashboard</a></li>
        <li><a href="index.php?page=profile">Profile</a></li>
        <li><a href="index.php?page=cart">Cart</a></li>
        <li><a href="index.php?page=orders">Orders</a></li>
        <li><a href="handlers/auth.handler.php?action=logout">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <?php
    $pagePath = BASE_PATH . "/pages/{$page}.php";
    if (file_exists($pagePath)) {
        include $pagePath;
    } else {
        echo "<p>❌ Page file not found: " . htmlspecialchars($pagePath) . "</p>";
    }
    ?>
  </main>

</body>
</html>
