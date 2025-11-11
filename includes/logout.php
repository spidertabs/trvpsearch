<?php
// includes/logout.php
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/functions.php';

// Logout user
if ($user->logout()) {
    // Successfully logged out, redirect to index page
    header('Location: ../');
    exit;
} else {
    // Logout failed, display error message
    echo 'Error: Unable to logout.';
}
?>