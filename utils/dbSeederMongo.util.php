<?php

require_once 'envSetter.util.php';

try {
    $uri = "mongodb://{$databases['mongoHost']}:{$databases['mongoPort']}";
    $client = new MongoDB\Client($uri);
    $db = $client->{$databases['mongoDB']};

    echo "🌱 Seeding MongoDB...\n";

    // Sample data for "users" collection
    $users = $db->users;

    $users->insertMany([
        ['name' => 'Alice', 'email' => 'alice@example.com', 'role' => 'admin'],
        ['name' => 'Bob', 'email' => 'bob@example.com', 'role' => 'editor'],
        ['name' => 'Charlie', 'email' => 'charlie@example.com', 'role' => 'viewer'],
    ]);

    // Sample data for "logs" collection
    $logs = $db->logs;

    $logs->insertOne([
        'event' => 'Seeder Run',
        'timestamp' => new MongoDB\BSON\UTCDateTime(),
        'status' => 'success',
    ]);

    echo "✅ MongoDB seeded successfully!\n";

} catch (Exception $e) {
    echo "❌ MongoDB seeding failed: " . $e->getMessage() . "\n";
}