<?php

require_once 'envSetter.util.php';

try {
    $dsn = "pgsql:host={$databases['pgHost']};port={$databases['pgPort']};dbname={$databases['pgDB']};";
    $pdo = new PDO($dsn, $databases['pgUser'], $databases['pgPassword']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "🌱 Seeding data...\n";

    // Insert roles
    $pdo->exec("
        INSERT INTO roles (name) VALUES
        ('admin'),
        ('editor'),
        ('viewer');
    ");

    // Insert permissions
    $pdo->exec("
        INSERT INTO permissions (name) VALUES
        ('create_post'),
        ('edit_post'),
        ('delete_post'),
        ('view_post');
    ");

    // Insert users
    $pdo->exec("
        INSERT INTO users (name, email, password) VALUES
        ('Alice', 'alice@example.com', 'password123'),
        ('Bob', 'bob@example.com', 'password123'),
        ('Charlie', 'charlie@example.com', 'password123');
    ");

    // Assign roles to users
    $pdo->exec("
        INSERT INTO role_user (user_id, role_id) VALUES
        (1, 1),  -- Alice = admin
        (2, 2),  -- Bob = editor
        (3, 3);  -- Charlie = viewer
    ");

    // Assign permissions to roles
    $pdo->exec("
        INSERT INTO permission_role (permission_id, role_id) VALUES
        (1, 1), (2, 1), (3, 1), (4, 1),  -- admin = all permissions
        (2, 2), (4, 2),                 -- editor = edit & view
        (4, 3);                         -- viewer = view only
    ");

    echo "✅ Seed complete!\n";

} catch (PDOException $e) {
    echo "❌ Seeding failed: " . $e->getMessage() . "\n";
}
