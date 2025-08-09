<?php

require_once 'envSetter.util.php';

try {
    $dsn = "pgsql:host={$databases['pgHost']};port={$databases['pgPort']};dbname={$databases['pgDB']};";
    $pdo = new PDO($dsn, $databases['pgUser'], $databases['pgPassword']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "🔄 Dropping existing tables (if any)...\n";
    $pdo->exec("DROP TABLE IF EXISTS users, roles, permissions, role_user, permission_role");

    echo "🛠 Creating tables...\n";

    $pdo->exec("
        CREATE TABLE users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            password VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE roles (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255)
        );

        CREATE TABLE permissions (
            id SERIAL PRIMARY KEY,
            name VARCHAR(255)
        );

        CREATE TABLE role_user (
            user_id INTEGER REFERENCES users(id),
            role_id INTEGER REFERENCES roles(id),
            PRIMARY KEY (user_id, role_id)
        );

        CREATE TABLE permission_role (
            permission_id INTEGER REFERENCES permissions(id),
            role_id INTEGER REFERENCES roles(id),
            PRIMARY KEY (permission_id, role_id)
        );
    ");

    echo "✅ Tables reset successfully!\n";

} catch (PDOException $e) {
    echo "❌ DB Reset failed: " . $e->getMessage() . "\n";
}