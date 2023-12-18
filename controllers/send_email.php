<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require '../vendor/autoload.php';

function sendEmail($Name, $Email, $subject, $body, $attachment = null)
{
    $message = '';

    // Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply.atsbcportal@gmail.com';
        $mail->Password = 'tppp ltjs kaai xavo'; //tppp ltjs kaai xavo
        $mail->Port = 587; // $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $mail->setFrom('noreply.atsbcportal@gmail.com', 'ATS Business Control Portal'); // Sender details
        $mail->addAddress($Email, $Name); // Set recipient details 

        // Check if $attachment has data and is not null
        if (!is_null($attachment)) {
            $mail->addAttachment($attachment); // Add attachment if it's not null
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        $message = 'Email has been Sent!';
    } catch (Exception $e) {
        $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    return $message;
}



function writeExcel($No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price, $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor, $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recomm, $BC_Recomm, $Approver_Name, $Date, $Remarks)
{
    try {
        $excel_msg = '';

        // Create a new instance of Excel
        $excel_pdf = new COM("Excel.Application.16");
        // Check if Excel instance is created successfully
        if (!$excel_pdf) {
            throw new Exception('Error: Microsoft Excel is not available.');
        }

        // Define the base directory
        $baseDirectory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files';

        // Create a folder for the Requestor if it doesn't exist
        $requestorFolder = $baseDirectory . '/excel/' . $Requestor;
        if (!file_exists($requestorFolder)) {
            mkdir($requestorFolder, 0777, true);
        }
        $savedExcelDirectory = $requestorFolder;
        $savedPDFDirectory = $baseDirectory . '/pdf';
        $inputFileName = $baseDirectory . '/excel/PPV Template.xlsx';

        // Load the Excel template
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        // Define the values you want to write to cells B8 to AG8
        $values = [
            $No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price,
            $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor,
            $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recomm, $BC_Recomm
        ];

        // Write values to cells B8 to AG8
        $row = 8;
        $col = 'B';
        foreach ($values as $value) {
            $worksheet->setCellValue($col . $row, $value);
            $col++;
        }

        // Set $Remarks to cell AI8
        $worksheet->setCellValue('AI8', $Remarks);
        // echo '<pre>';
        // echo 'Approved: ' . print_r($Approver_Name['Approved'], true) . '<br>';
        // echo 'Disapproved: ' . print_r($Approver_Name['Disapproved'], true) . '<br>';
        // echo '</pre>';

        // Check if 'Disapproved' key exists in $Approver_Name and insert it into cell AG8
        if (isset($Approver_Name['Disapproved'])) {
            $worksheet->setCellValue('AG8', $Approver_Name['Disapproved']);
        }

        // Iterate through the arrays and set cell values
        for ($i = 0; $i < count($Approver_Name['Approved']); $i++) {
            // Check if 'Approved' key exists in $Approver_Name
            if (isset($Approver_Name['Approved'][$i])) {
                // If the 'Approved' key contains an array, use implode to concatenate the names
                $approvedName = $Approver_Name['Approved'][$i];
                $worksheet->setCellValue('AF' . (8 + $i), $approvedName);
            }
            // Check if Date array has data before accessing elements
            if (isset($Date[$i])) {
                $worksheet->setCellValue('AH' . (8 + $i), $Date[$i]);
            }
        }

        // Save the modified content of the Excel file
        $outputExcelFileName = $savedExcelDirectory . '/PPV(' . $Requestor . ')(' . $No . ').xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($outputExcelFileName);

        // Open the Excel file
        $workbook = $excel_pdf->Workbooks->Open($outputExcelFileName);

        // Define the PDF output path
        $pdfPath = $savedPDFDirectory . '/PPV(' . $Requestor . ')(' . $No . ').pdf';

        // Access the first worksheet
        $worksheet = $workbook->Worksheets(1);

        // Check the result of ExportAsFixedFormat
        $exportResult = $worksheet->ExportAsFixedFormat(0, $pdfPath); // 0 represents PDF format

        $excel_msg = true;
    } catch (Exception $e) {
        $excel_msg = 'Error: ' . $e->getMessage();
    } finally {
        // Close the workbook and quit Excel in the finally block to ensure cleanup
        if (isset($workbook)) {
            $workbook->Close();
            $workbook = null;
        }

        if (isset($excel_pdf)) {
            $excel_pdf->Quit();
            $excel_pdf = null;
        }
    }

    return $excel_msg;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['send']))) {
    $profile_email = $_POST['email'];
    $profile_name = $_POST['name'];
    $subject = "Email Confirmation";
    $body = "If you receive this email, please note that it will be used for sending emails from ATS Business Control Portal. <br> Thank you! <br><i>***This is an auto generated message, please do not reply***<i>";

    $profile = sendEmail($profile_name, $profile_email, $subject, $body);
    // Return a response as JSON
    $response = array(
        'success' => ($profile == 'Email has been Sent!'),
        'message' => $profile
    );

    echo json_encode($response);
    exit();
}


// function writeExcel($No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price, $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor, $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recomm, $BC_Recomm, $Approved_by, $Date_Approved)
// {
//     $excel_msg = '';
//     $excel_pdf = new COM("Excel.Application.16");

//     if (!$excel_pdf) {
//         $excel_msg = 'Error: Microsoft Excel is not available.';
//         return $excel_msg;
//     }

//     // Define the base directory
//     $baseDirectory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files';

//     // Create a folder for the Requestor if it doesn't exist
//     $requestorFolder = $baseDirectory . '/excel/' . $Requestor;
//     if (!file_exists($requestorFolder)) {
//         mkdir($requestorFolder, 0777, true);
//     }

//     // Create a folder for the PDFs for the Requestor if it doesn't exist
//     $requestorPdfFolder = $baseDirectory . '/PDF/' . $Requestor;
//     if (!file_exists($requestorPdfFolder)) {
//         mkdir($requestorPdfFolder, 0777, true);
//     }

//     $inputFileName = $baseDirectory . '/excel/PPV Template.xlsx';

//     try {
//         // Load the Excel template
//         $inputFileName = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files/excel/PPV Template.xlsx';
//         $spreadsheet = IOFactory::load($inputFileName);
//         $worksheet = $spreadsheet->getActiveSheet();

//         // Define the values you want to write to cells B8 to AG8
//         $values = [
//             $No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price,
//             $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor,
//             $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recomm, $BC_Recomm,
//             $Approved_by, $Date_Approved
//         ];

//         // Write values to cells B8 to AG8
//         $row = 8;
//         $col = 'B';
//         foreach ($values as $value) {
//             $worksheet->setCellValue($col . $row, $value);
//             $col++;
//         }

//         // Save the modified content of the Excel file
//         $outputExcelFileName = $requestorFolder . '/PPV(' . $Requestor . ')(' . $No . ').xlsx';
//         $writer = new Xlsx($spreadsheet);
//         $writer->save($outputExcelFileName);

//         // Open the Excel file
//         $workbook = $excel_pdf->Workbooks->Open($outputExcelFileName);

//         // Access the first worksheet
//         $worksheet = $workbook->Worksheets(1);

//         // Define the PDF output path
//         $pdfPath = $requestorPdfFolder . '/PPV(' . $Requestor . ')(' . $No . ').pdf';

//         // Check the result of ExportAsFixedFormat
//         $exportResult = $worksheet->ExportAsFixedFormat(0, $pdfPath); // 0 represents PDF format

//         if ($exportResult) {
//             $excel_msg = "Excel file converted to PDF and saved as $pdfPath.<br>";
//         } else {
//             $excel_msg = 'Error: PDF export failed.';
//         }

//         // Close the workbook and quit Excel
//         if ($workbook) {
//             $workbook->Close();
//             $workbook = null;  // Release the COM object
//         }

//         if ($excel_pdf) {
//             $excel_pdf->Quit();
//             $excel_pdf = null;  // Release the COM object
//         }
//     } catch (Exception $e) {
//         $excel_msg = 'Error: ' . $e->getMessage();
//     }

//     return $excel_msg;
// }