<?php

// Update the path to the correct location of your database configuration file
require_once __DIR__ . '/../config/database.php';  // Adjust the path if needed

function runMigration() {
    global $pdo;  // Make sure you have PDO connected to the database

    // Step 1: Ensure migrations table exists (if you're tracking migrations)
    $createMigrationsTableSQL = "
    CREATE TABLE IF NOT EXISTS migrations (
        id SERIAL PRIMARY KEY,
        migration_name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";

    try {
        $pdo->exec($createMigrationsTableSQL);
    } catch (PDOException $e) {
        echo "Error creating migrations table: " . $e->getMessage();
        exit();
    }

    // Step 2: Check if this migration has already been applied
    $migrationName = '2025_08_05_01_create_users_table';  // This should be unique to each migration
    $checkMigrationSQL = "SELECT 1 FROM migrations WHERE migration_name = ?";
    $stmt = $pdo->prepare($checkMigrationSQL);
    $stmt->execute([$migrationName]);

    if ($stmt->rowCount() > 0) {
        echo "Migration '$migrationName' has already been applied.\n";
        return;  // Exit if the migration has already been applied
    }

    // Step 3: Run the actual migration (create users table)
    $sql = "
    CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) DEFAULT 'user',
        remember_token VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ";

    try {
        // Execute the SQL query to create the table
        $pdo->exec($sql);
        echo "Migration ran successfully: users table created.\n";

        // Step 4: Insert migration record
        $insertMigrationSQL = "INSERT INTO migrations (migration_name) VALUES (?)";
        $stmt = $pdo->prepare($insertMigrationSQL);
        $stmt->execute([$migrationName]);

    } catch (PDOException $e) {
        echo "Error running migration: " . $e->getMessage();
        exit();
    }
}

// Call the function to run the migration
runMigration();
