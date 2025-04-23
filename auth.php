<?php
$lifetime = 60 * 60 * 24 * 7;
session_set_cookie_params($lifetime);
session_start();

// Logout handler
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    session_unset();
    session_destroy();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    header("Location: login.php?loggedout=true");
    exit();
}

// Access control: call a function from main file
function protect($requiredRole = null) {
    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    if ($requiredRole && $_SESSION['role'] !== $requiredRole) {
        header("Location: login.php");
        exit();
    }
}
?>