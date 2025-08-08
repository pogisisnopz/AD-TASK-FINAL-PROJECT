<?php
session_start();

$host = 'host.docker.internal';  
$dbname = 'ad_task_db';  
$username = 'poginisnopz';  
$password = 'password123';  

$pdo = null;

try {
    $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validatePassword($password)
{
    return strlen($password) >= 8;
}

function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle signup action
if (isset($_POST['action']) && $_POST['action'] == 'signup') {
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']);
    
    $_SESSION['form_data'] = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email
    ];

    // Validate inputs
    $errors = [];

    if (empty($first_name)) {
        $errors[] = "First name is required";
    }

    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }

    if (empty($email) || !validateEmail($email)) {
        $errors[] = "Valid email is required";
    }

    if (empty($password) || !validatePassword($password)) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (!$terms) {
        $errors[] = "You must agree to the terms and conditions";
    }

    // Check if email already exists in the database
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $errors[] = "Email already exists";
            }
        } catch (Exception $e) {
            $errors[] = "Database error occurred: " . $e->getMessage();
        }
    }

    // If validation fails, redirect back with error messages
    if (!empty($errors)) {
        $_SESSION['error_message'] = implode(". ", $errors);
        header("Location: ../pages/signup.php");
        exit();
    }

    // Hash password and insert new user
    try {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$first_name, $last_name, $email, $hashed_password]);

        unset($_SESSION['form_data']);
        $_SESSION['success_message'] = "Account created successfully! Please login.";
        header("Location: ../pages/login.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Registration failed. Please try again. " . $e->getMessage();
        header("Location: ../pages/signup.php");
        exit();
    }
} 
// Handle login action
elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me']);

    $_SESSION['form_data'] = ['email' => $email];

    // Validate input
    if (empty($email) || empty($password)) {
        $_SESSION['error_message'] = "Email and password are required";
        header("Location: ../pages/login.php");
        exit();
    }

    // Check user credentials
    try {
        $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];
            $_SESSION['user_email'] = $user['email'];

            unset($_SESSION['form_data']);

            // Update last login time
            $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
            $stmt->execute([$user['id']]);

            // Remember me functionality
            if ($remember_me) {
                $token = bin2hex(random_bytes(32));
                setcookie('remember_token', $token, time() + (86400 * 30), '/'); // 30 days

                $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
                $stmt->execute([$token, $user['id']]);
            }

            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid email or password";
            header("Location: ../pages/login.php");
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Login failed. Please try again.";
        header("Location: ../pages/login.php");
        exit();
    }
} 
// Handle logout action
elseif (isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Clear remember me cookie if set
    if (isset($_COOKIE['remember_token'])) {
        setcookie('remember_token', '', time() - 3600, '/');
        if (isset($_SESSION['user_id'])) {
            try {
                $stmt = $pdo->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
                $stmt->execute([$_SESSION['user_id']]);
            } catch (Exception $e) {
                // Handle error silently
            }
        }
    }

    // Destroy session
    session_destroy();

    header("Location: ../index.php");
    exit();
} 
else {
    // Invalid action or no action specified
    header("Location: ../index.php");
    exit();
}
?>
