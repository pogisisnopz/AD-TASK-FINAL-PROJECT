<?php

declare(strict_types=1);

// 1) Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

// 2) Bootstrap
require_once __DIR__ . '/../bootstrap.php';

// 3) Env Setter (for accessing database config)
require_once BASE_PATH . '/utils/envSetter.util.php';

// Fetch the DB connection data
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

// 4) Connect to PostgreSQL
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// 5) Check if this migration has been applied
$migration_name = '2025_08_05_01_create_users_table';
$stmt = $pdo->prepare('SELECT 1 FROM migrations WHERE migration_name = :migration_name');
$stmt->execute(['migration_name' => $migration_name]);
if ($stmt->fetch()) {
    echo "Migration already applied.\n";
    exit;
}

// 6) SQL for creating the users table
$sql = "
    CREATE TABLE IF NOT EXISTS users (
        id uuid PRIMARY KEY DEFAULT uuid_generate_v4(),
        first_name VARCHAR(225) NOT NULL,
        last_name VARCHAR(225) NOT NULL,
        email VARCHAR(225) NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
";

$pdo->exec($sql);
echo "Users table created.\n";

// 7) Log this migration as applied
$stmt = $pdo->prepare('INSERT INTO migrations (migration_name) VALUES (:migration_name)');
$stmt->execute(['migration_name' => $migration_name]);

echo "Migration applied successfully!\n";
