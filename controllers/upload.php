<?php
require_once 'db.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && isset($_POST['product'])) {
        $file = $_FILES['file']['tmp_name'];
        $fileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $qbomType = $_POST['product']; // Get the QBOM type from the hidden input field
        $swapModule = $_POST['swapOption'];
        // Define an array of allowed file extensions
        $allowedExtensions = ['xlsx', 'xls', 'csv'];

        // Check if the uploaded file has an allowed extension
        if (!in_array($fileType, $allowedExtensions)) {
            $response['status'] = 'error';
            $response['message'] = "Only .xlsx, .xls, and .csv files are allowed.";
        } else {

            try {
                // Truncate (clear) the specific QBOM table before inserting new data
                switch ($qbomType) {
                    case 'SWAP':
                        switch ($swapModule) {
                            case 'Swap Housing':
                                $table = 'swap1_qbom';
                                break;
                            case 'Preciser':
                                $table = 'swap2_qbom';
                                break;
                            case 'Robot Add On':
                                $table = 'swap3_qbom';
                                break;
                            case 'Gripper Robot':
                                $table = 'swap4_qbom';
                                break;
                            case 'Service Station':
                                $table = 'swap5_qbom';
                                break;
                            case 'Accessories':
                                $table = 'swap6_qbom';
                                break;
                            default:
                                $table = '';
                                break;
                        }
                        $insertQuery = "INSERT INTO $table (`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Sequence`, `Original_Unit_Price`, `Original_Currency`,`Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'SWAP CABLE':
                        $table = 'swapcable_qbom';
                        $insertQuery = "INSERT INTO swapcable_qbom (`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Sequence`, `Original_Unit_Price`, `Original_Currency`,`Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'PNP':
                        $table = 'pnp_qbom';
                        $insertQuery = "INSERT INTO pnp_qbom (`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`,`Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'PNP CABLE':
                        $table = 'pnpcable_qbom';
                        $insertQuery = "INSERT INTO `pnpcable_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?)";
                        break;
                    case 'JLP':
                        $table = 'jlp_qbom';
                        $insertQuery = "INSERT INTO `jlp_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'JLP CABLE':
                        $table = 'jlpcable_qbom';
                        $insertQuery = "INSERT INTO `jlpcable_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?)";
                        break;
                    case 'JTP':
                        $table = 'jtp_qbom';
                        $insertQuery = "INSERT INTO `jtp_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'MTP':
                        $table = 'mtp_qbom';
                        $insertQuery = "INSERT INTO `mtp_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty_1`, `EXT_Qty_2`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'OLB':
                        $table = 'olb_qbom';
                        $insertQuery = "INSERT INTO `olb_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'OLB CABLE':
                        $table = 'olbcable_qbom';
                        $insertQuery = "INSERT INTO `olbcable_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'FLIPPER':
                        $table = 'flipper_qbom';
                        $insertQuery = "INSERT INTO `flipper_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'HIGHMAG':
                        $table = 'highmag_qbom';
                        $insertQuery = "INSERT INTO `highmag_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'IONIZER':
                        $table = 'ionizer_qbom';
                        $insertQuery = "INSERT INTO `ionizer_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Purchase_Vendor`, `Vendor_PN`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?)";
                        break;
                    case 'RCMTP':
                        $table = 'rcmtp_qbom';
                        $insertQuery = "INSERT INTO `rcmtp_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    case 'ECLIPSE XTA':
                        $table = 'eclipse_xta_qbom';
                        $insertQuery = "INSERT INTO `eclipse_xta_qbom`(`Changes_Analysis`, `Level`, `Item`, `Item_Description`, `Item_class`, `Qty`, `EXT_Qty`, `QPA_0`, `UoM`, `Rev`, `Drawing_Sequence_Number`, `Sequence`, `Original_Unit_Price`, `Original_Currency`, `Unit_Price_USD_before_Mark_Up`, `Standard_Part_Price`, `Purchase_Identification`, `Mark_Up`, `Unit_Price_USD_after_Mark_Up`, `Total_Price_USD`, `Agreement`, `Agreement_Price`, `Agreement_Currency`, `Spare_Part_Price_USD`, `Supplier_MOQ`, `Lead_Time`, `Supplier_Vendor`, `Supplier_Vendor_Reference`, `Manufacturer`, `Manufacturer_Reference_MPN`, `Agreement_Supplier_Name`, `Agreement_Supplier_Code`, `Life_Cycle`, `Purchasing_Restriction`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        break;
                    default:
                        $table = '';
                        $insertQuery = '';

                        break;
                }
                if ($table && $insertQuery) {
                    try {
                        $truncateQuery = "TRUNCATE TABLE `ats_bc`.`$table`";
                        $truncateStmt = $pdo->prepare($truncateQuery);
                        $truncateStmt->execute();

                        // Create a new Spreadsheet object
                        $spreadsheet = IOFactory::load($file);

                        if ($qbomType === 'SWAP') {
                            // Iterate through worksheets 1 to 5
                            // for ($i = 0; $i <= 5; $i++) {
                            //     $worksheet = $spreadsheet->getSheet($i);
                            $worksheet = $spreadsheet->getActiveSheet();

                            // Echo out the name of the worksheet
                            // echo "Processing Worksheet: " . $worksheet->getTitle() . PHP_EOL;
                            // Initialize a column count variable
                            $columnCount = 0;

                            foreach ($worksheet->getRowIterator() as $row) {
                                // Skip the first row (headers)
                                if ($row->getRowIndex() === 1) {
                                    continue;
                                }

                                // Increment the row counter
                                $data = [];
                                $cellIterator = $row->getCellIterator();
                                $cellIterator->setIterateOnlyExistingCells(true);

                                foreach ($cellIterator as $cell) {
                                    // Check if the column is hidden
                                    $columnIndex = $cell->getColumn();
                                    if ($worksheet->getColumnDimension($columnIndex)->getVisible()) {
                                        $columnCount++;
                                        $cellValue = $cell->getCalculatedValue();
                                        // Handle empty values by replacing them with NULL or an empty string
                                        $data[] = ($cellValue === null) ? null : $cellValue;
                                    }
                                }
                                // Check if the row has fewer values than the total number of columns
                                $missingColumns = 33 - count($data);

                                // Add null or empty values for the missing columns
                                for ($j = 0; $j < $missingColumns; $j++) {
                                    $data[] = null;
                                }
                                // echo count($data);
                                // print_r($data);
                                // Prepare and Execute Insert Query
                                $stmt = $pdo->prepare($insertQuery);

                                // Bind parameters as needed
                                for ($j = 1; $j <= count($data); $j++) {
                                    $stmt->bindParam($j, $data[$j - 1]);
                                }

                                if (!$stmt->execute()) {
                                    throw new Exception("Error inserting data into the database.");
                                }
                            }
                            // }
                        } else {
                            // Get the active sheet
                            $worksheet = $spreadsheet->getActiveSheet();

                            // Initialize a column count variable
                            $columnCount = 0;

                            foreach ($worksheet->getRowIterator() as $row) {
                                // Skip the first row (headers)
                                if ($row->getRowIndex() === 1) {
                                    continue;
                                }

                                $data = [];
                                $cellIterator = $row->getCellIterator();
                                $cellIterator->setIterateOnlyExistingCells(true);

                                foreach ($cellIterator as $cell) {
                                    // Check if the column is hidden
                                    $columnIndex = $cell->getColumn();
                                    if ($worksheet->getColumnDimension($columnIndex)->getVisible()) {
                                        $columnCount++;
                                        $cellValue = $cell->getCalculatedValue();
                                        // Handle empty values by replacing them with NULL or an empty string
                                        $data[] = ($cellValue === null) ? null : $cellValue;
                                        // Check if the cell is not empty
                                        if ($cellValue !== null && $cellValue !== '') {
                                            $isRowEmpty = false;
                                        }
                                    }
                                }

                                // print_r($data);
                                // echo count($data);
                                if (!$isRowEmpty) {
                                    $stmt = $pdo->prepare($insertQuery);
                                    // Bind parameters as needed
                                    for ($i = 1; $i <= count($data); $i++) {
                                        $stmt->bindParam($i, $data[$i - 1]);
                                    }

                                    // Execute with an array of parameters
                                    if (!$stmt->execute()) {
                                        throw new Exception("Error inserting data into the database.");
                                    }
                                }
                            }
                        }
                        // If the loop completes without errors, set a success message
                        $message = "Data imported successfully for $qbomType QBOM.";
                        $response['status'] = 'success';
                        $response['message'] = $message;
                    } catch (Exception $e) {
                        // Handle the exception
                        $message = $e->getMessage();
                        $response['status'] = 'error';
                        $response['message'] = $message;
                    }
                } else {
                    // Handle the case when $qbomType is not recognized
                    $message = "Invalid QBOM type: $qbomType";
                    $response['status'] = 'error';
                    $response['message'] = $message;
                }
                // if ($table && $insertQuery) {
                //     try {
                //         $truncateQuery = "TRUNCATE TABLE `ats_bc`.`$table`";
                //         $truncateStmt = $pdo->prepare($truncateQuery);
                //         $truncateStmt->execute();

                //         // Create a new Spreadsheet object
                //         $spreadsheet = IOFactory::load($file);

                //         // Get the active sheet
                //         $worksheet = $spreadsheet->getActiveSheet();
                //         // // Get the highest column (assuming headers are in the first row)
                //         // $highestColumn = $worksheet->getHighestColumn();

                //         // // Convert the column letter to a numeric index
                //         // $columnCount = Coordinate::columnIndexFromString($highestColumn);

                //         // // Prepare the insert query
                //         // $placeholders = implode(',', array_fill(1, $columnCount, '?'));

                //         // $insertStmt = $pdo->prepare($insertQuery);

                //         // // Iterate through rows and insert data
                //         // foreach ($worksheet->getRowIterator() as $row) {
                //         //     // Skip the header row
                //         //     if ($row->getRowIndex() === 1) {
                //         //         continue;
                //         //     }

                //         //     $rowData = [];
                //         //     foreach ($row->getCellIterator() as $cell) {
                //         //         $rowData[] = $cell->getValue();
                //         //     }
                //         //     echo '<pre>';
                //         //     print_r($rowData);
                //         //     echo '</pre>';
                //         //     // Bind parameters and execute the statement
                //         //     $insertStmt->execute($rowData);
                //         // }


                //         // Add a counter variable to track the current row number
                //         $rowCounter = 0;

                //         // Initialize a column count variable
                //         $columnCount = 0;

                //         foreach ($worksheet->getRowIterator() as $row) {
                //             // Increment the row counter
                //             $rowCounter++;

                //             // Skip the first row (header row)
                //             if ($rowCounter === 1) {
                //                 continue;
                //             }

                //             $data = [];
                //             $cellIterator = $row->getCellIterator();
                //             $cellIterator->setIterateOnlyExistingCells(false);

                //             foreach ($cellIterator as $cell) {
                //                 // Check if the column is hidden
                //                 $columnIndex = $cell->getColumn();
                //                 if ($worksheet->getColumnDimension($columnIndex)->getVisible()) {
                //                     $columnCount++;
                //                     $cellValue = $cell->getCalculatedValue();
                //                     // Handle empty values by replacing them with NULL or an empty string
                //                     $data[] = ($cellValue === null) ? null : $cellValue;
                //                     // Check if the cell is not empty
                //                     if ($cellValue !== null && $cellValue !== '') {
                //                         $isRowEmpty = false;
                //                     }
                //                 }
                //             }

                //             // Remove the last element if it's empty
                //             if (!empty($data) && end($data) === null && $qbomType !== "IONIZER") {
                //                 array_pop($data);
                //             }

                //             // echo count($data);
                //             if (!$isRowEmpty) {
                //                 $stmt = $pdo->prepare($insertQuery);
                //                 // Bind parameters as needed
                //                 for ($i = 1; $i <= count($data); $i++) {
                //                     $stmt->bindParam($i, $data[$i - 1]);
                //                 }

                //                 if (!$stmt->execute()) {
                //                     throw new Exception("Error inserting data into the database.");
                //                 }
                //             }
                //         }

                //         // If the loop completes without errors, set a success message
                //         $message = "Data imported successfully for $qbomType QBOM.";
                //         $response['status'] = 'success';
                //         $response['message'] = $message;
                //     } catch (Exception $e) {
                //         // Handle the exception
                //         $message = $e->getMessage();
                //         $response['status'] = 'error';
                //         $response['message'] = $message;
                //     }
                // } else {
                //     // Handle the case when $qbomType is not recognized
                //     $message = "Invalid QBOM type: $qbomType";
                //     $response['status'] = 'error';
                //     $response['message'] = $message;
                // }
                // if ($table && $insertQuery) {
                //     $truncateQuery = "TRUNCATE TABLE `ats_bc`.`$table`";
                //     $truncateStmt = $pdo->prepare($truncateQuery);
                //     $truncateStmt->execute();

                //     // Create a new Spreadsheet object
                //     $spreadsheet = IOFactory::load($file);

                //     // Get the active sheet
                //     $worksheet = $spreadsheet->getActiveSheet();

                //     // Add a counter variable to track the current row number
                //     $rowCounter = 0;

                //     // Initialize a column count variable
                //     $columnCount = 0;

                //     foreach ($worksheet->getRowIterator() as $row) {
                //         // Increment the row counter
                //         $rowCounter++;

                //         // Skip the first row (header row)
                //         if ($rowCounter === 1) {
                //             continue;
                //         }

                //         $data = [];
                //         $cellIterator = $row->getCellIterator();
                //         $cellIterator->setIterateOnlyExistingCells(false);

                //         foreach ($cellIterator as $cell) {
                //             // Check if the column is hidden
                //             $columnIndex = $cell->getColumn();
                //             if ($worksheet->getColumnDimension($columnIndex)->getVisible()) {
                //                 $columnCount++;
                //                 $cellValue = $cell->getCalculatedValue();
                //                 // Handle empty values by replacing them with NULL or an empty string
                //                 $data[] = ($cellValue === null || $cellValue === '') ? null : $cellValue;
                //                 // Check if the cell is not empty
                //                 if ($cellValue !== null && $cellValue !== '') {
                //                     $isRowEmpty = false;
                //                 }
                //             }
                //         }

                //         // Remove the last element if it's empty
                //         if (!empty($data) && end($data) === null && $qbomType !== "IONIZER") {
                //             array_pop($data);
                //         }
                //         // echo '<pre>';
                //         // print_r($data);
                //         // echo '</pre>';
                //         // echo count($data);
                //         if (!$isRowEmpty) {
                //             $stmt = $pdo->prepare($insertQuery);
                //             // Bind parameters as needed
                //             for ($i = 1; $i <= count($data); $i++) {
                //                 $stmt->bindParam($i, $data[$i - 1]);
                //             }
                //         }


                //         if (!$stmt->execute()) {
                //             throw new Exception("Error inserting data into the database.");
                //         }
                //     }
                //     // If the loop completes without errors, set a success message
                //     $message = "Data imported successfully for $qbomType QBOM.";
                //     $response['status'] = 'success';
                //     $response['message'] = $message;
                // } else {
                //     // Handle the case when $qbomType is not recognized
                //     $message = "Invalid QBOM type: $qbomType";
                //     $response['status'] = 'error';
                //     $response['message'] = $message;
                // }
            } catch (Exception $e) {
                // Handle the exception (e.g., log the error or display a user-friendly error message)
                $message = "An error occurred: " . $e->getMessage();
                $response['status'] = 'error';
                $response['message'] = $message;
            }
        }

        echo json_encode($response);
        exit();
    } elseif (isset($_FILES['upload_bu_file'])) {
        $file_bu = $_FILES['upload_bu_file']['tmp_name'];
        $fileExtension = strtolower(pathinfo($_FILES['upload_bu_file']['name'], PATHINFO_EXTENSION));

        // Define an array of allowed file extensions
        $allowedExtensions = ['xlsx', 'xls', 'csv'];

        // Check if the file extension is in the list of allowed extensions
        if (in_array($fileExtension, $allowedExtensions)) {
            try {
                // Truncate (clear) the bu table before inserting new data
                $truncateQuery = "TRUNCATE TABLE `ats_bc`.`bu`";
                $truncateStmt = $pdo->prepare($truncateQuery);
                $truncateStmt->execute();

                // Create a new Spreadsheet object
                $spreadsheet = IOFactory::load($file_bu);

                // Get the active sheet
                $worksheet = $spreadsheet->getActiveSheet();

                // Add a counter variable to track the current row number
                $rowCounter = 0;

                foreach ($worksheet->getRowIterator() as $row) {
                    // Increment the row counter
                    $rowCounter++;

                    // Skip the first row (header row)
                    if ($rowCounter === 1) {
                        continue;
                    }

                    $data = [];
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    foreach ($cellIterator as $cell) {
                        // Get the displayed value as plain text (exclude formulas)
                        $data[] = $cell->getCalculatedValue();
                    }

                    // Modify this SQL query to match your table structure
                    $sql = "INSERT INTO bu (No,Item_No,Item_Description,Foreign_Name,Cost_Center ) VALUES (?, ?, ?, ?, ?)";

                    $stmt = $pdo->prepare($sql);

                    // Bind parameters as needed
                    for ($i = 1; $i <= 5; $i++) {
                        $stmt->bindParam($i, $data[$i - 1]);
                    }

                    if (!$stmt->execute()) {
                        throw new Exception("Error inserting data into the database.");
                    }
                }
                $response = [
                    'success' => true,
                    'message' => 'Data imported successfully!'
                ];
            } catch (Exception $e) {
                $response = [
                    'success' => false,
                    'message' => 'An error occurred: ' . $e->getMessage()
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Invalid file type. Only xlsx, xls, and csv files are allowed.'
            ];
        }
        echo json_encode($response);
        exit();
    }
}

$pdo = null; // Close the database connection
exit();
