<?php
// db.php

$host = 'localhost';        // Database host
$port = '5432';             // Database port (default for PostgreSQL)
$dbname = 'ad_task_db';     // Your database name
$user = 'postgres';         // Your PostgreSQL username
$password = 'password123';  // Your PostgreSQL password

// Create a connection string
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    // Establish the database connection
    $pdo = new PDO($dsn, $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // Handle any connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
