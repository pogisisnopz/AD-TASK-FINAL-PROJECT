<?php
require_once __DIR__ . '/../utils/auth.util.php';

if (!currentUserId()) {
    header('Location: ../index.php?page=login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
  <div class="dashboard-container">
      <h1>👋 Welcome to your Dashboard!</h1>
      <p><strong>User ID:</strong> <?= currentUserId(); ?></p>
      <p><strong>Role:</strong> <?= currentUserRole(); ?></p>

      <a href="../handlers/auth.handler.php?action=logout">🔓 Logout</a>
  </div>
</body>
</html>
