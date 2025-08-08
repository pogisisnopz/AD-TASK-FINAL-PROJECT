<?php
require_once __DIR__ . '/envSetter.util.php';


function login($emailOrId, $password) {
    global $databases;

    try {
        $dsn = "pgsql:host={$databases['pgHost']};port={$databases['pgPort']};dbname={$databases['pgDB']}";
        $pdo = new PDO($dsn, $databases['pgUser'], $databases['pgPassword']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :e OR id = :e LIMIT 1");
        $stmt->execute([':e' => $emailOrId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'] ?? 'user'; // Assuming there's a 'role' column
            return $user;
        }

    } catch (PDOException $e) {
        error_log("Login DB Error: " . $e->getMessage());
    }

    return false;
}

function logout() {
    session_unset();
    session_destroy();
}

function currentUserId() {
    return $_SESSION['user_id'] ?? null;
}

function currentUserRole() {
    return $_SESSION['user_role'] ?? null;
}
