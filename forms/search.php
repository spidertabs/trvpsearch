<?php
// forms/search.php
require_once './../includes/connect/beta.php';

// Create an instance of Trvpsearch class with the database connection
$trvpSearch = new Trvpsearch($link);

// Call the search function
$response = $trvpSearch->search();

// Check the response and handle it
if ($response['success']) {
    // If successful, get the courses data
    $courses = $response['data'];

    // Display the courses data or process it as needed
    foreach ($courses as $course) {
        // Example: Print the course name and other details
        echo 'Course Name: ' . htmlspecialchars($course['course_title']) . '<br>'; // Adjust the column names as needed
        // Add more fields if necessary
    }
} else {
    // If there was an error, display the error message
    echo 'Error: ' . htmlspecialchars($response['message']);
}
