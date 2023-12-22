<?php
// Specify the directory path
$directory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/pdf';

// Get the list of files in the directory
$files = scandir($directory);

// Filter out "." and ".." entries
$files = array_diff($files, array('..', '.'));

// Prepare the response
$response = [];

foreach ($files as $file) {
    $response[] = $file;
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
