<?php
set_time_limit(60); // Set a 60-second (1-minute) timeout

try {
    $excel = new COM("Excel.Application.16") or die("Unable to instantiate Excel");
    echo "Excel application is started.<br>";

    // Open the Excel file
    $workbook = $excel->Workbooks->Open('C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/excel/PPV(Ako Si Requestor 1).xlsx');

    // Access the first worksheet
    $worksheet = $workbook->Worksheets(1);

    // Define the PDF output path
    $pdfPath = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/PDF/SKKRTZ.pdf';

    // Save the Excel file as PDF
    $worksheet->ExportAsFixedFormat(0, $pdfPath); // 0 represents PDF format

    // Close the workbook
    $workbook->Close();

    // Quit Excel
    $excel->Quit();
    $workbook = null;
    $worksheet = null;

    echo "Excel file converted to PDF and saved as $pdfPath.<br>";
} catch (com_exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "<br>";
}
