<?php
if (isset($_GET['file'])) {
    $file = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/pdf/' . $_GET['file'];
    if (file_exists($file)) {
        // Set the appropriate content type for PDF files
        header('Content-Type: application/pdf');
        // Use inline disposition for viewing in the browser
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
