<?php
session_start();

// Require HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') {
    die("HTTPS is required");
}

// Browser fingerprint check
if (!isset($_SESSION['browser']) || $_SESSION['browser'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_destroy();
    die("Session hijacking attempt detected");
}

// Check login status
if (!isset($_SESSION['username'])) {
    header("Location: /project1/index.php");
    exit();

}

// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
