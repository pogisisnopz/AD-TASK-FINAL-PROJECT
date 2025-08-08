<?php
require_once __DIR__ . '/../bootstrap.php';
require_once BASE_PATH . '/utils/auth.util.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is already logged in
if (currentUserId()) {
    header("Location: ../index.php?page=home");
    exit;
}

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?page=signup");
    exit;
}

// Get form data
$first_name = trim($_POST['first_name'] ?? '');
$last_name = trim($_POST['last_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$terms = isset($_POST['terms']);
$newsletter = isset($_POST['newsletter']);

// Validation
$errors = [];

// Required fields
if (empty($first_name)) {
    $errors[] = 'First name is required';
}

if (empty($last_name)) {
    $errors[] = 'Last name is required';
}

if (empty($email)) {
    $errors[] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?page=signup&error=invalid_email");
    exit;
}

if (empty($username)) {
    $errors[] = 'Username is required';
} elseif (strlen($username) < 3) {
    $errors[] = 'Username must be at least 3 characters long';
}

if (empty($password)) {
    $errors[] = 'Password is required';
} elseif (strlen($password) < 8) {
    header("Location: ../index.php?page=signup&error=weak_password");
    exit;
}

if ($password !== $confirm_password) {
    header("Location: ../index.php?page=signup&error=passwords_mismatch");
    exit;
}

if (!$terms) {
    $errors[] = 'You must agree to the terms and conditions';
}

// If there are validation errors, redirect back
if (!empty($errors)) {
    header("Location: ../index.php?page=signup&error=validation");
    exit;
}

try {
    // Database connection (adjust according to your database setup)
    $pdo = new PDO("mysql:host=localhost;dbname=ableplay", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        header("Location: ../index.php?page=signup&error=email_exists");
        exit;
    }

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        header("Location: ../index.php?page=signup&error=username_exists");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user
    $stmt = $pdo->prepare("
        INSERT INTO users (first_name, last_name, email, username, password, newsletter_subscribed, created_at, updated_at) 
        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
    
    $stmt->execute([
        $first_name,
        $last_name,
        $email,
        $username,
        $hashed_password,
        $newsletter ? 1 : 0
    ]);

    // Get the new user ID
    $user_id = $pdo->lastInsertId();

    // Optional: Send welcome email
    // sendWelcomeEmail($email, $first_name);

    // Optional: Log the registration
    error_log("New user registered: ID=$user_id, Email=$email, Username=$username");

    // Redirect to login with success message
    header("Location: ../index.php?page=login&success=registration_complete");
    exit;

} catch (PDOException $e) {
    // Log the error
    error_log("Database error during registration: " . $e->getMessage());
    
    // Redirect with generic error
    header("Location: ../index.php?page=signup&error=database");
    exit;
} catch (Exception $e) {
    // Log the error
    error_log("General error during registration: " . $e->getMessage());
    
    // Redirect with generic error
    header("Location: ../index.php?page=signup&error=server");
    exit;
}

// Function to send welcome email (optional - implement as needed)
function sendWelcomeEmail($email, $first_name) {
    // Implement email sending logic here
    // You can use PHPMailer, mail() function, or any email service
    
    $subject = "Welcome to AblePlay!";
    $message = "
        <html>
        <head>
            <title>Welcome to AblePlay</title>
        </head>
        <body>
            <h2>Welcome to AblePlay, $first_name!</h2>
            <p>Thank you for joining our gaming community. We're excited to have you aboard!</p>
            <p>You can now log in to your account and start exploring our games and features.</p>
            <p>If you have any questions, feel free to contact our support team.</p>
            <p>Happy gaming!</p>
            <p>The AblePlay Team</p>
        </body>
        </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@ableplay.com" . "\r\n";
    
    // mail($email, $subject, $message, $headers);
}
?>