<?php
// Define the password for the admin
$password = 'admin';

// Hash the password using bcrypt
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Output the hashed password
echo "Hashed Admin Password: " . $hashed_password;
?>
