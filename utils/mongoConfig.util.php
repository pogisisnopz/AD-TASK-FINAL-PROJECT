<?php
// mongoConfig.util.php

// Ensure this file includes the necessary MongoDB driver
require_once 'vendor/autoload.php'; // If you're using Composer's autoloader

// MongoDB connection details
define('MONGO_HOST', 'host.docker.internal'); // Docker internal hostname
define('MONGO_PORT', '27017'); // Default MongoDB port
define('MONGO_DB', 'admin'); // Default MongoDB database
define('MONGO_USER', 'poginisnopz'); // MongoDB user
define('MONGO_PASSWORD', 'password123'); // MongoDB password

// MongoDB connection string
$mongoConnectionString = sprintf(
    'mongodb://%s:%s@%s:%s',
    MONGO_USER,
    MONGO_PASSWORD,
    MONGO_HOST,
    MONGO_PORT
);

try {
    // Create a new MongoDB Manager instance
    $mongo = new MongoDB\Driver\Manager($mongoConnectionString);

    // Test MongoDB connection (ping the server)
    $command = new MongoDB\Driver\Command(['ping' => 1]);
    $mongo->executeCommand(MONGO_DB, $command);

    // If successful, output success message
    echo "✅ MongoDB connection successful!\n";
} catch (MongoDB\Driver\Exception\Exception $e) {
    // In case of an error, output the error message
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "\n";
}
