<?php
// Helper functions and logic

// Include the user class, pass in the database connection
require_once __DIR__ . '/../classes/user.php';

// Initialize the Trvpsearch class
if (isset($link)) {
    $user = new Trvpsearch($link);
    $get = new Trvpsearch($link);
}