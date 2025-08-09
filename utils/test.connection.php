<?php
// Ensure bootstrap is loaded and autoload necessary classes
require_once dirname(__DIR__) . '/bootstrap.php';  // Ensure bootstrap is loaded
require_once BASE_PATH . '/vendor/autoload.php';  // Autoload necessary classes

// Load environment variables using Dotenv (make sure to install "vlucas/phpdotenv" via Composer)
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH); 
$dotenv->load();

// Debugging: Check environment variables (optional)
echo "<h3>Environment Variables</h3>";
echo "<pre>";
var_dump($_ENV); // Will output all environment variables to check if they're loaded correctly
echo "</pre>";

// Retrieve PostgreSQL credentials from environment variables
$host = $_ENV['PG_HOST'] ?? 'postgres';  // Fallback to 'postgres' if not set
$port = $_ENV['PG_PORT'] ?? '5432';  // Fallback to '5432' if not set
$dbname = $_ENV['PG_DB'] ?? 'ad_task_db';  // Fallback to 'ad_task_db' if not set
$user = $_ENV['PG_USER'] ?? 'poginisnopz';  // Fallback to 'poginisnopz' if not set
$password = $_ENV['PG_PASSWORD'] ?? 'password123';  // Fallback to 'password123' if not set

// Debugging: Output connection details to verify they are correct
echo "<h3>Connection Details</h3>";
echo "Host: $host<br>";
echo "Port: $port<br>";
echo "DB Name: $dbname<br>";
echo "User: $user<br>";

// Test the connection to the PostgreSQL database
try {
    // Create a PDO instance to connect to the PostgreSQL database
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Set the PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection is successful, this message will be displayed
    echo "Connected to the database successfully!";
} catch (PDOException $e) {
    // If connection fails, catch the exception and display the error message
    echo "Connection failed: " . $e->getMessage();
}
?>  