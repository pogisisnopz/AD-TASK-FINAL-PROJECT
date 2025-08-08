<?php

require_once 'envSetter.util.php';  // Ensure environment variables are loaded

// Retrieve values from the environment file
$host = $databases['pgHost'];
$port = $databases['pgPort'];
$username = $databases['pgUser'];
$password = $databases['pgPassword'];
$dbname = $databases['pgDB'];

try {
    // Set up the connection string
    $dsn = "pgsql:host={$host};port={$port};dbname={$dbname};";
    
    // Attempt to create a new PDO connection
    $pdo = new PDO($dsn, $username, $password);
    
    // Check if the connection is successful
    echo "✅ PostgreSQL connection successful!\n";
} catch (PDOException $e) {
    // Handle the error gracefully and display the message
    echo "❌ PostgreSQL connection failed: " . $e->getMessage() . "\n";
}
