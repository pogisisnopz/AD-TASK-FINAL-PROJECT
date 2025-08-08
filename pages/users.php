<?php
require_once __DIR__ . '/../utils/auth.util.php';

if (!currentUserId()) {
    header('Location: index.php?page=login');
    exit;
}


$userId = currentUserId();
?>

<h2>User Dashboard</h2>

<ul>
    <li><a href="index.php?page=profile">👤 My Profile</a></li>
    <li><a href="index.php?page=cart">🛒 My Cart</a></li>
    <li><a href="index.php?page=orders">📦 My Orders</a></li>
    <li><a href="handlers/auth.handler.php?action=logout">🚪 Logout</a></li>
</ul>
