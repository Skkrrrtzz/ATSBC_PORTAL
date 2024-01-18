<?php
$baseDirectory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files';
$excelFile = $baseDirectory . '/excel/Approved_PPV.xlsx';

// Set headers to prompt the browser to download the file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Approved_PPV.xlsx"');
header('Cache-Control: max-age=0');

// Output the file to the browser
readfile($excelFile);
