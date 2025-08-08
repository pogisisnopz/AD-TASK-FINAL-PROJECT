<?php

require_once dirname(__DIR__) . '/bootstrap.php';  // Ensure bootstrap is loaded
require_once BASE_PATH . '/vendor/autoload.php';  // Autoload necessary classes

// Load environment variables using Dotenv
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// Create an array with the environment variables
$databases = [
    // PostgreSQL
    'pgHost' => $_ENV['PG_HOST'],
    'pgPort' => $_ENV['PG_PORT'],
    'pgUser' => $_ENV['PG_USER'],
    'pgPassword' => $_ENV['PG_PASSWORD'],
    'pgDB' => $_ENV['PG_DB'],

    // MongoDB
    'mongoHost' => $_ENV['MONGO_HOST'],
    'mongoPort' => $_ENV['MONGO_PORT'],
    'mongoDB' => $_ENV['MONGO_DB'],
];
