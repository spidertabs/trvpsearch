<?php
// includes/auth.php - Combined authentication file for signup and signin
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/functions.php';

$errors = [];
$data = [];
$get = new Trvpsearch($link);

// Determine which action to perform based on the request
$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'signup') {
    // SIGNUP LOGIC
    // Validate inputs
    $school = trim($_POST["school"]);
    $programme = trim($_POST["programme"]);
    $fullname = trim($_POST["fullname"]);
    $regNo = trim($_POST["regNo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate school
    $isValidSchool = $get->isValidSchool($school);
    if (!$isValidSchool['success']) {
        $errors['school'] = $isValidSchool['message'];
    }

    // Validate programme
    $isValidProgramme = $get->isValidProgramme($programme);
    if (!$isValidProgramme['success']) {
        $errors['programme'] = $isValidProgramme['message'];
    }

    // Validate fullname
    $isValidFullname = $get->isValidFullname($fullname);
    if (!$isValidFullname['success']) {
        $errors['fullname'] = $isValidFullname['message'];
    }

    // Validate regNo
    $isValidRegNo = $get->isValidRegNo($regNo);
    if (!$isValidRegNo['success']) {
        $errors['regNo'] = $isValidRegNo['message'];
    } else {
        $check_regNo = $get->check_regNo($regNo);
        if (!$check_regNo['success']) {
            $errors['regNo'] = $check_regNo['message'];
        }
    }

    // Validate email
    $isValidEmail = $get->isValidEmail($email);
    if (!$isValidEmail['success']) {
        $errors['email'] = $isValidEmail['message'];
    } else {
        $check_email = $get->check_email($email);
        if (!$check_email['success']) {
            $errors['email'] = $check_email['message'];
        }
    }

    // Validate password
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
        $student = $get->createStudent($school, $programme, $fullname, $regNo, $email, $password);
        if ($student['success']) {
            $data['message'] = $student['message'];
        } else {
            $data['success'] = false;
            $data['errors'] = $student['message'];
        }
    }

} elseif ($action === 'signin') {
    // SIGNIN LOGIC
    // Validate inputs
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Validate email
    $isValidEmail = $get->isValidEmail($email);
    if (!$isValidEmail['success']) {
        $errors['email'] = $isValidEmail['message'];
    } else {
        // Validate password
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
        $login = $get->loginWithEmail($email, $password);
        if ($login['success']) {
            $data['message'] = $login['message'];
        } else {
            $data['success'] = false;
            $data['errors']['login'] = $login['message'];
        }
    }

} else {
    // Invalid action
    $data['success'] = false;
    $data['errors']['action'] = 'Invalid action specified';
}

echo json_encode($data);
?>