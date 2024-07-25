<?php
// forms/accounts/signin,php

// Initialize the session
include('./../../includes/connect/gamma.php');

$errors = [];
$data = [];
$get = new Trvpsearch($link);

// validate inputs
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

// validate email
$isValidEmail = $get->isValidEmail($email);
if (!$isValidEmail['success']) {
    $errors['email'] = $isValidEmail['message'];
} else {
    // validate password
    $isValidPassword = $get->isValidPassword($password);
    if (!$isValidPassword['success']) {
        $errors['password'] = $isValidPassword['message'];
    }
}

// Check input errors before signing in
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    //$data['message'] = "signupSuccess";
    
    $login = $get->loginWithEmail($email, $password);
    if ($login['success']) {
        $data['message'] = $login['message']; // Get the message from the createStudent method
    } else {
        $data['success'] = false;
        $data['errors']['login'] = $login['message']; // Return error as 'login' key
    }
}

echo json_encode($data);