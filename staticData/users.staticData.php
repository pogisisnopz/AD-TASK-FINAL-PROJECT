<?php
// Static data for users to seed into the database
return [
    // User 1 - Admin
    [
        'username' => 'alice.smith',
        'first_name' => 'Alice',
        'last_name' => 'Smith',
        'password' => 'p@ssW0rd1234',  // Password should be hashed in the seeder
        'role' => 'admin',  // Role is assigned here, ensure role exists in the DB
    ],

    // User 2 - Editor
    [
        'username' => 'bob.johnson',
        'first_name' => 'Bob',
        'last_name' => 'Johnson',
        'password' => 'editor1234',
        'role' => 'editor',
    ],

    // User 3 - Viewer
    [
        'username' => 'charlie.brown',
        'first_name' => 'Charlie',
        'last_name' => 'Brown',
        'password' => 'viewonly123',
        'role' => 'viewer',
    ],

    // Add more users as needed...
];
?>
