<?php
require('./../includes/connect/beta.php');
//logout
if ($user->logout()) {
    //logged in return to index page
    header('Location: ./../');
    exit;
} else {
    // logout failed, display error message
    echo 'Error: Unable to logout.';
}
