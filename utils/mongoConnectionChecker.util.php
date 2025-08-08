<?php

require_once 'envSetter.util.php';  // Ensure environment variables are loaded

try {
    // Build MongoDB URI with authentication
    $uri = "mongodb://{$databases['mongoHost']}:{$databases['mongoPort']}";

    // Initialize MongoDB client with authentication
    $client = new MongoDB\Client($uri, [
        'username' => $_ENV['MONGO_INITDB_ROOT_USERNAME'],  // MongoDB username
        'password' => $_ENV['MONGO_INITDB_ROOT_PASSWORD'],  // MongoDB password
        'authSource' => 'admin'  // Auth source database, typically "admin"
    ]);
    
    // Select the database
    $db = $client->selectDatabase($databases['mongoDB']);

    // If no exception, connection was successful
    echo "✅ MongoDB connection successful!\n";
} catch (Exception $e) {
    // Handle any errors and print the failure message
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "\n";
}
