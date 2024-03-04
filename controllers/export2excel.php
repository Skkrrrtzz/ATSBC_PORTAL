<?php
require_once 'db.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

require '../vendor/autoload.php';

// Check if the request is coming from the button click
if (isset($_POST['export'])) {

    $aprvd = "SELECT No,Date_Received,Requestor,Project,Delta_PN,SAP_PN,Description,QPA,PR_Qty,UoM,Prev_Price,PPV_Type,Current_Vendor,New_Price_1,Currency_1,LT_1,SPQ_1,MOQ_1,Qty2PurchasetoVendor_1,Total_Amt_1,New_Vendor,New_Price_2,Currency_2,LT_2,SPQ_2,MOQ_2,Qty2PurchasetoVendor_2,Total_Amt_2,Purchasing_Recom,QBOM_Unit_Price,Conversion_Rate_V1,V1_VarianceVSQBOM,bc_recomm,Approver_Name_1,VarianceChargable2Cohu,Date_Approved_1,Remarks FROM `ppv` WHERE Request_Status='Approved' ";
    $stmt_approved = $pdo->prepare($aprvd);
    $stmt_approved->execute();
    $approved_result = $stmt_approved->fetchAll(PDO::FETCH_ASSOC);
    $values = $approved_result;
    writeExcel($values);

    echo "success";
}

function writeExcel($values)
{
    try {
        $excel_msg = '';
        $baseDirectory = 'C:/xampp/htdocs/ATS/ATSBC_PORTAL/data_files';
        $inputFileName = $baseDirectory . '/excel/PPV_Form.xlsx';

        // Load the Excel template
        $spreadsheet = IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();

        // Define the target row and column for writing values
        $startRow = 8;
        $startCol = 'B';

        // Get the style of the first row from column B to AL
        $firstRowStyle = $worksheet->getStyle('B8:AL8');

        // Iterate through values and write to cells
        // foreach ($values as $rowValues) {
        //     foreach ($rowValues as $columnName => $value) {
        //         // Check if the column name is 'Date_Approved_1'
        //         if ($columnName === 'Date_Approved_1' && !empty($value)) {
        //             // Parse the date and format it as m/d/Y h:i A
        //             $date = new DateTime($value);
        //             $formattedDate = $date->format('m/d/Y h:i A');

        //             $worksheet->setCellValue($startCol . $startRow, $formattedDate);
        //         } else {
        //             $worksheet->setCellValue($startCol . $startRow, $value);
        //         }
        //         $startCol++;
        //     }

        //     // Duplicate the style from the first row to the current row
        //     $worksheet->duplicateStyle($firstRowStyle, 'B' . $startRow . ':AJ' . $startRow);

        //     $startRow++;
        //     $startCol = 'B';
        // }
        foreach ($values as $rowValues) {
            foreach ($rowValues as $columnName => $value) {
                if ($columnName === 'Date_Approved_1' && !empty($value)) {
                    // Parse the date and format it as m/d/Y h:i A
                    $date = new DateTime($value);
                    $formattedDate = $date->format('m/d/Y h:i A');

                    $worksheet->setCellValue($startCol . $startRow, $formattedDate);
                } else {
                    $formattedDate = $value;
                    $worksheet->setCellValue($startCol . $startRow, $formattedDate);
                }
                $startCol++;
            }

            // Duplicate the style from the first row to the current row
            $worksheet->duplicateStyle(
                $firstRowStyle,
                'B' . $startRow . ':AL' . $startRow
            );

            $startRow++;
            $startCol = 'B';
        }
        // Save the modified spreadsheet
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $outputFileName = $baseDirectory . '/excel/Approved_PPV.xlsx';
        $writer->save($outputFileName);

        $excel_msg = 'success';
    } catch (\Exception $e) {
        $excel_msg = $e->getMessage();
    }
    return $excel_msg;
}
