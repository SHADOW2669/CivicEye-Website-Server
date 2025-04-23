<?php
// Set custom session cookie params if used
$lifetime = 60 * 60 * 24 * 7;
session_set_cookie_params($lifetime);

// Start the session
session_start();

// Clear all session variables
session_unset();

// Destroy the session data
session_destroy();

// Expire the session cookie manually
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login
header("Location: login.php");
exit();
