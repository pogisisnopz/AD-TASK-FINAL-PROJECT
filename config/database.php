<?php
// Database configuration
$host = 'host.docker.internal';  // Host for the Docker environment
$dbname = 'ad_task_db';  // Database name
$username = 'poginisnopz';  // Database username
$password = 'password123';  // Database password

// Create a PDO connection to PostgreSQL
try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
