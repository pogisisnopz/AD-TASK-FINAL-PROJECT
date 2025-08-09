<?php
// Load environment variables
require_once '../.env';

// Database connection settings
$host = getenv('PG_HOST');
$port = getenv('PG_PORT');
$dbname = getenv('PG_DB');
$user = getenv('PG_USER');
$password = getenv('PG_PASSWORD');

// Connect to PostgreSQL
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to PostgreSQL!\n";

    // Create table (if not exists)
    $pdo->exec("CREATE TABLE IF NOT EXISTS test_table (id SERIAL PRIMARY KEY, name VARCHAR(100))");

    // Insert data
    $stmt = $pdo->prepare("INSERT INTO test_table (name) VALUES (:name)");
    $stmt->execute(['name' => 'John Doe']);

    // Read data
    $stmt = $pdo->query("SELECT * FROM test_table");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id'] . ': ' . $row['name'] . "\n";
    }

    // Update data
    $stmt = $pdo->prepare("UPDATE test_table SET name = :name WHERE id = :id");
    $stmt->execute(['name' => 'Jane Doe', 'id' => 1]);

    // Delete data
    $stmt = $pdo->prepare("DELETE FROM test_table WHERE id = :id");
    $stmt->execute(['id' => 1]);

    echo "CRUD operations completed successfully.\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
