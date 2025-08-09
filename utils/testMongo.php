<?php
// Include MongoDB Client
require 'vendor/autoload.php';  // If using Composer

// Create MongoDB client
$mongoClient = new MongoDB\Client("mongodb://poginisnopz:password123@mongo:27017/mydb");

// Select the collection
$collection = $mongoClient->mydb->myCollection;

// Insert new data
$insertResult = $collection->insertOne([
    'name' => 'John Doe',
    'age' => 30
]);

echo "Inserted with ObjectId '{$insertResult->getInsertedId()}'";

// Query the collection to verify the insertion
$result = $collection->findOne(['name' => 'John Doe']);
echo '<pre>';
print_r($result);
echo '</pre>';
?>
