<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

$savedExcelDirectory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/excel';

$inputFileName = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/excel/PPV Template.xlsx';

try {
    $spreadsheet = IOFactory::load($inputFileName);
    $worksheet = $spreadsheet->getActiveSheet();

    // Get the value from cell C10
    $valueC10 = $worksheet->getCell('C10')->getValue();

    // Modify the value from cell C10 (e.g., set it to a new value)
    $worksheet->getCell('C10')->setValue('Skkkrttzz');

    // Save the modified content of the Excel file
    $outputExcelFileName = $savedExcelDirectory . '/PPV(Skkrrtz).xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($outputExcelFileName);

    // Load the modified Excel content
    $spreadsheet = IOFactory::load($outputExcelFileName);

    // Convert Excel file to PDF using Mpdf
    $pdfOutput = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/PDF/SKKRTZ.pdf';
    $mpdf = new Mpdf(['mode' => 'utf-8', 'orientation' => 'L']);

    // Export the Excel content as HTML
    ob_start();
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
    $writer->save('php://output');
    $html = ob_get_clean();

    // Write the HTML to PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output($pdfOutput, 'F');

    echo "New Excel file saved as $outputExcelFileName<br>";
    echo "New PDF file saved as $pdfOutput<br>";
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
