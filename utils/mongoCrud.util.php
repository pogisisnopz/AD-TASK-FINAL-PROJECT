<?php

require 'vendor/autoload.php'; // Include MongoDB client

$client = new MongoDB\Client("mongodb://localhost:27017");
$collection = $client->yourDatabase->yourCollection;

// CREATE
function createDocument($data) {
    global $collection;
    $result = $collection->insertOne($data);
    echo "Inserted with Object ID '{$result->getInsertedId()}'\n";
}

// READ
function readDocuments() {
    global $collection;
    $documents = $collection->find();
    foreach ($documents as $doc) {
        print_r($doc);
    }
}

// UPDATE
function updateDocument($filter, $updateData) {
    global $collection;
    $result = $collection->updateOne($filter, ['$set' => $updateData]);
    echo "Matched {$result->getMatchedCount()} document(s)\n";
}

// DELETE
function deleteDocument($filter) {
    global $collection;
    $result = $collection->deleteOne($filter);
    echo "Deleted {$result->getDeletedCount()} document(s)\n";
}

?>
