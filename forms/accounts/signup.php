<?php
// forms/accounts/signup,php

// Initialize the session
include('./../../includes/connect/gamma.php');

$errors = [];
$data = [];
$get = new Trvpsearch($link);

// validate inputs
$school = trim($_POST["school"]);
$programme = trim($_POST["programme"]);
$fullname = trim($_POST["fullname"]);
$regNo = trim($_POST["regNo"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

// validate school
$isValidSchool = $get->isValidSchool($school);
if (!$isValidSchool['success']) {
    $errors['school'] = $isValidSchool['message'];
}

// validate programme
$isValidProgramme = $get->isValidProgramme($programme);
if (!$isValidProgramme['success']) {
    $errors['programme'] = $isValidProgramme['message'];
}

// validate fullname
$isValidFullname = $get->isValidFullname($fullname);
if (!$isValidFullname['success']) {
    $errors['fullname'] = $isValidFullname['message'];
}

// validate regNo
$isValidRegNo = $get->isValidRegNo($regNo);
if (!$isValidRegNo['success']) {
    $errors['regNo'] = $isValidRegNo['message'];
} else {
    $check_regNo = $get->check_regNo($regNo);
    if (!$check_regNo['success']) {
        $errors['regNo'] = $check_regNo['message'];
    }
}

// validate email
$isValidEmail = $get->isValidEmail($email);
if (!$isValidEmail['success']) {
    $errors['email'] = $isValidEmail['message'];
} else {
    $check_email = $get->check_email($email);
    if (!$check_email['success']) {
        $errors['email'] = $check_email['message'];
    }
}

// validate password
$isValidPassword = $get->isValidPassword($password);
if (!$isValidPassword['success']) {
    $errors['password'] = $isValidPassword['message'];
}

// Check input errors before inserting in database
if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    //$data['message'] = "afterSignup";
    
    $student = $get->createStudent($school, $programme, $fullname, $regNo, $email, $password);
    if ($student['success']) {
        $data['message'] = $student['message']; // Get the message from the createStudent method
    } else {
        $data['success'] = false;
        $data['errors'] = $student['message'];
    }
}

echo json_encode($data);