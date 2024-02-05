<?php
require_once 'db.php';
include_once 'send_email.php';
if (isset($_GET['No'])) {
    $No = $_GET['No'];

    $select_sql = "SELECT * FROM ppv WHERE No = :No";
    $stmt_select = $pdo->prepare($select_sql);
    $stmt_select->bindParam(':No', $No, PDO::PARAM_STR);
    $stmt_select->execute();
    $select_result = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($select_result)) {
        foreach ($select_result as $row) {

            $Date_Requested = $row['Date_Received'];
            $Requestor = $row['Requestor'];
            $Project = $row['Project'];
            $SAP_PN = $row['SAP_PN'];
            $Delta_PN = $row['Delta_PN'];
            $Description = $row['Description'];
            $QPA = $row['QPA'];
            $PR_Qty = $row['PR_Qty'];
            $Purchase_Qty = $row['Purchase_Qty'];
            $UoM = $row['UoM'];
            $Prev_Price = $row['Prev_Price'];
            $Currency = $row['Currency'];
            $PPV_Type = $row['PPV_Type'];
            $other_ppv_type = $row['other_ppv_type'];
            $Current_Vendor = $row['Current_Vendor'];
            $New_Price_1 = $row['New_Price_1'];
            $Currency_1 = $row['Currency_1'];
            $LT_1 = $row['LT_1'];
            $SPQ_1 = $row['SPQ_1'];
            $MOQ_1 = $row['MOQ_1'];
            $Qty2PurchasetoVendor_1 = $row['Qty2PurchasetoVendor_1'];
            $Total_Amt_1 = $row['Total_Amt_1'];
            $New_Vendor = $row['New_Vendor'];
            $New_Price_2 = $row['New_Price_2'];
            $Currency_2 = $row['Currency_2'];
            $LT_2 = $row['LT_2'];
            $SPQ_2 = $row['SPQ_2'];
            $MOQ_2 = $row['MOQ_2'];
            $Qty2PurchasetoVendor_2 = $row['Qty2PurchasetoVendor_2'];
            $Total_Amt_2 = $row['Total_Amt_2'];
            $Purchasing_Recom = $row['Purchasing_Recom'];
            $QBOM_Unit_Price = $row['QBOM_Unit_Price'];
            $Total_QBOM_Price = $row['Total_QBOM_Price'];
            $Conversion_Rate_V1 = $row['Conversion_Rate_V1'];
            $V1_Converted_Price = $row['V1_Converted_Price'];
            $Conversion_Rate_V2 = $row['Conversion_Rate_V2'];
            $V2_Converted_Price = $row['V2_Converted_Price'];
            $V1_VarianceVSQBOM = $row['V1_VarianceVSQBOM'];
            $V2_VarianceVSQBOM = $row['V2_VarianceVSQBOM'];
            $Chargable2Customer = $row['Chargable2Customer'];
            $Remarks_from_CCP_analyst = $row['Remarks_from_CCP_analyst'];
            $For_Checking_of_CCP_analyst = $row['For_Checking_of_CCP_analyst'];
            $VarianceChargable2Cohu = $row['VarianceChargable2Cohu'];
            $BC_Recomm = $row['bc_recomm'];
            $Variance_VS_QBOM_Price = $row['variance_vs_qbomprice'];
            $CCP_Name = $row['CCP_Name'];
            $Reason = $row['reason'];
            $originalDate = $row['CCP_Checked_date'];
            $timestamp = strtotime($originalDate);
            $CCP_date = date('m/d/y h:i A', $timestamp);
            if (empty($originalDate) || is_null($originalDate)) {
                $check_date = NULL;
            } else {
                $check_date = $CCP_date;
            }

            $Approver = $Role;
            $ApvCheck1 = $row['Approver_Check_1'];
            $ApvName1 = $row['Approver_Name_1'];
            $ApvCheck2 = $row['Approver_Check_2'];
            $ApvName2 = $row['Approver_Name_2'];

            $ApvDate1 = (!empty($row['Date_Approved_1'])) ? formatApprovalDate($row['Date_Approved_1']) : '';
            $ApvDate2 = (!empty($row['Date_Approved_2'])) ? formatApprovalDate($row['Date_Approved_2']) : '';
            $ApvDate3 = (!empty($row['Date_Approved_3'])) ? formatApprovalDate($row['Date_Approved_3']) : '';

            $Remarks = $row['Remarks'];
        }
    } else {
        // echo "No records found for No = $No";
        $Date_Requested = "";
        $Requestor = "";
        $Project = "";
        $SAP_PN = "";
        $Delta_PN = "";
        $Description = "";
        $QPA = "";
        $PR_Qty = "";
        $Purchase_Qty = "";
        $UoM = "";
        $Prev_Price = "";
        $Currency = "";
        $PPV_Type = "";
        $other_ppv_type = "";
        $Current_Vendor = "";
        $New_Price_1 = "";
        $Currency_1 = "";
        $LT_1 = "";
        $SPQ_1 = "";
        $MOQ_1 = "";
        $Qty2PurchasetoVendor_1 = "";
        $Total_Amt_1 = "";
        $Reason = "";
        $New_Vendor = "";
        $New_Price_2 = "";
        $Currency_2 = "";
        $LT_2 = "";
        $SPQ_2 = "";
        $MOQ_2 = "";
        $Qty2PurchasetoVendor_2 = "";
        $Total_Amt_2 = "";
        $Purchasing_Recom = "";
        $QBOM_Unit_Price = "";
        $Total_QBOM_Price = "";
        $Conversion_Rate_V1 = "";
        $V1_Converted_Price = "";
        $Conversion_Rate_V2 = "";
        $V2_Converted_Price = "";
        $V1_VarianceVSQBOM = "";
        $V2_VarianceVSQBOM = "";
        $Chargable2Customer = "";
        $Remarks_from_CCP_analyst = "";
        $For_Checking_of_CCP_analyst = "";
        $VarianceChargable2Cohu = "";
        $BC_Recomm = "";
        $Variance_VS_QBOM_Price = "";
        $CCP_Name = "";
        $check_date = "";
        $Approver = "";
        $ApvCheck1 = "";
        $ApvCheck2 = "";
        $ApvCheck3 = "";
        $ApvDate1 = "";
        $ApvDate2 = "";
        $ApvDate3 = "";
    }
} else {
    if (isset($_POST['bcaForm'])) {
        try {
            $updateApvSql = "UPDATE ppv SET 
            QBOM_Unit_Price = :QBOM_UP,
            Total_QBOM_Price = :Total_QBOM_P,
            Conversion_Rate_V1 = :CRV1,
            V1_Converted_Price = :V1CP,
            Conversion_Rate_V2 = :CRV2,
            V2_Converted_Price = :V2CP,
            V1_VarianceVSQBOM = :V1V_VS_QBOM,
            V2_VarianceVSQBOM = :V2V_VS_QBOM,
            Chargable2Customer = :Chargable2Customer,
            VarianceChargable2Cohu = :VC2COHU,
            For_Checking_of_CCP_analyst = :CCP_A
            WHERE No = :No";

            $selectPPVSql = "SELECT name, email FROM users WHERE role ='Optional Approver'";
            $stmt1 = $pdo->prepare($selectPPVSql);
            if (!$stmt1) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt1->execute();
            $row = $stmt1->fetch(PDO::FETCH_ASSOC);

            $Name = $row['name'];
            $Email = $row['email'];

            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':No', $_POST['No']);
            $stmt->bindParam(':QBOM_UP', $_POST['QBOM_Unit_Price']);
            $stmt->bindParam(':Total_QBOM_P', $_POST['Total_QBOM_Price']);
            $stmt->bindParam(':CRV1', $_POST['Conversion_Rate_Vendor_1']);
            $stmt->bindParam(':V1CP', $_POST['Vendor_1_Converted_Price']);
            $stmt->bindParam(':CRV2', $_POST['Conversion_Rate_Vendor_2']);
            $stmt->bindParam(':V2CP', $_POST['Vendor_2_Converted_Price']);
            $stmt->bindParam(':V1V_VS_QBOM', $_POST['Vendor_1_Variance_VS_QBOM']);
            $stmt->bindParam(':V2V_VS_QBOM', $_POST['Vendor_2_Variance_VS_QBOM']);
            $stmt->bindParam(':Chargable2Customer', $_POST['Chargable_to_Customer']);
            $stmt->bindParam(':VC2COHU', $_POST['Variance_Chargable_to_Cohu']);
            $stmt->bindParam(':CCP_A', $_POST['For_Checking_of_CCP_analyst']);

            if ($stmt->execute()) {
                $subject = "For CCP Analyst";
                $body = "You have a new pending item in ATS Business Control Portal.<br> Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. Thank you!<br><i>***This is an auto-generated message, please do not reply***<i>";

                $message = sendEmail($Name, $Email, $subject, $body);

                $response = [
                    'success' => true,
                    'message' => 'Form has been submitted and sent to CCP analyst!',
                    'redirect' => 'sor_dashboard.php'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit the form!, Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

        echo json_encode($response);
        exit();
    } elseif (isset($_POST['apvForm'])) {

        $No = $_POST['No'];
        $QBOM_Unit_Price = $_POST['QBOM_Unit_Price'];
        $Total_QBOM_Price = $_POST['Total_QBOM_Price'];
        $Conversion_Rate_Vendor_1 = $_POST['Conversion_Rate_Vendor_1'];
        $Vendor_1_Converted_Price = $_POST['Vendor_1_Converted_Price'];
        $Conversion_Rate_Vendor_2 = $_POST['Conversion_Rate_Vendor_2'] ?? null;
        $Vendor_2_Converted_Price = $_POST['Vendor_2_Converted_Price'] ?? null;
        $Vendor_1_VarianceVSQBOM = $_POST['Vendor_1_Variance_VS_QBOM'];
        $Vendor_2_VarianceVSQBOM = $_POST['Vendor_2_Variance_VS_QBOM'] ?? null;
        $Variance_Chargable2_Cohu = $_POST['Variance_Chargable_to_Cohu'];
        $C2C_value = $_POST['Chargable_to_Customer'];
        $BC_Recomm = $_POST['Business_Control_Recommendation'];
        $Variance_VS_QBOM_Price = $_POST['Variance_VS_QBOM_Price'];
        $ApvCheck1 = $_POST['approved_check1'];
        $ApvBy1 = $_POST['approved_by_1'];
        $DApvCheck = $_POST['disapproved_check'];
        $DApv = $_POST['disapproved_by'];
        $date_1 = $_POST['date_1'];
        $Request_Status = isset($_POST['Request_Status']) ? $_POST['Request_Status'] : '';
        $Approver = ($_POST['Approver'] === 'Approver 3') ? 'Approver 2' : $_POST['Approver'];
        // Determine $Status based on the $Approver
        $Status = (($Approver === 'Approver 2' || $Approver === 'Approver 3') && $Request_Status === 'Approved') ? 'IN-PROCESS' : 'DONE';


        // Create a DateTime object from the input string
        $datetime = DateTime::createFromFormat('m/d/Y, h:i:s A', $date_1);

        // Format the DateTime object to MySQL-readable date format
        $mysqlDate1 = $datetime->format('Y-m-d H:i:s');

        $Remarks = $_POST['remarks'];

        try {
            $updateApvSql = "UPDATE ppv SET QBOM_Unit_Price = :QBOM_UP, Total_QBOM_Price = :Total_QBOM_P, Conversion_Rate_V1 = :CRV1, V1_Converted_Price = :V1CP, Conversion_Rate_V2 = :CRV2, V2_Converted_Price = :V2CP, V1_VarianceVSQBOM = :V1V_VS_QBOM, V2_VarianceVSQBOM = :V2V_VS_QBOM, Chargable2Customer = :Chargable2Customer, VarianceChargable2Cohu = :VC2COHU, bc_recomm = :BC_Recomm,variance_vs_qbomprice = :VVS_QBOMPrice,Approver_Check_1 = :ApvCheck1, Approver_Name_1 = :ApvBy1,Date_Approved_1 = :date_1,DisApproved = :DApvCheck, DisApprover_Name = :DApv,Remarks = :Remarks, Approver = :Approver,Status = :Status, Request_Status =:Request_Status WHERE No = :No";
            // 
            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':QBOM_UP', $QBOM_Unit_Price);
            $stmt->bindParam(':Total_QBOM_P', $Total_QBOM_Price);
            $stmt->bindParam(':CRV1', $Conversion_Rate_Vendor_1);
            $stmt->bindParam(':V1CP', $Vendor_1_Converted_Price);
            $stmt->bindParam(':CRV2', $Conversion_Rate_Vendor_2);
            $stmt->bindParam(':V2CP', $Vendor_2_Converted_Price);
            $stmt->bindParam(':V1V_VS_QBOM', $Vendor_1_VarianceVSQBOM);
            $stmt->bindParam(':V2V_VS_QBOM', $Vendor_2_VarianceVSQBOM);
            $stmt->bindParam(':Chargable2Customer', $C2C_value);
            $stmt->bindParam(':VC2COHU', $Variance_Chargable2_Cohu);
            $stmt->bindParam(':BC_Recomm', $BC_Recomm);
            $stmt->bindParam(':VVS_QBOMPrice', $Variance_VS_QBOM_Price);
            $stmt->bindParam(':ApvCheck1', $ApvCheck1);
            $stmt->bindParam(':ApvBy1', $ApvBy1);
            $stmt->bindParam(':DApvCheck', $DApvCheck);
            $stmt->bindParam(':DApv', $DApv);
            $stmt->bindParam(':date_1', $mysqlDate1);
            $stmt->bindParam(':Remarks', $Remarks);
            $stmt->bindParam(':Approver', $Approver);
            $stmt->bindParam(':Status', $Status);
            $stmt->bindParam(':Request_Status', $Request_Status);
            $stmt->bindParam(':No', $No);

            if ($stmt->execute()) {

                $response = [
                    'success' => true,
                    'message' => 'Form has been submitted!'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit form!, Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['remarks'])) {
        $CCP_Remarks = $_POST['Remarks_from_CCP_analyst'];
        $No = $_POST['No'];
        $checker_name = $_POST['checker_name'];
        $check_date = $_POST['checked_date'];

        try {
            $updateApvSql = "UPDATE ppv SET Remarks_from_CCP_analyst = :Remarks_CCP,CCP_Name=:checker_name,CCP_Checked_date =:checked_date WHERE No = :No";

            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':Remarks_CCP', $CCP_Remarks);
            $stmt->bindParam(':checker_name', $checker_name);
            $stmt->bindParam(':checked_date', $check_date);
            $stmt->bindParam(':No', $No);

            // Use the $message variable in your response array
            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'Form has been submitted!',
                    'redirect' => 'sor_dashboard.php'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit Remarks!, Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['apv1'])) {
        $No = $_POST['No'];
        $Request_Status = $_POST['Request_Status'];
        try {

            $selectPPVSql = "SELECT u.name, u.email FROM ppv p LEFT JOIN users u ON p.Requestor = u.name WHERE p.No =:No;";
            $selectPPV_No = "SELECT * FROM ppv WHERE No =:No;";

            $stmt1 = $pdo->prepare($selectPPVSql);
            $stmt2 = $pdo->prepare($selectPPV_No);

            if (!$stmt1 || !$stmt2) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }

            $stmt1->bindParam(':No', $No);
            $stmt2->bindParam(':No', $No);

            if ($stmt1->execute()) {
                $row = $stmt1->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $Name = $row['name'];
                    $Email = $row['email'];

                    // Fetch the data for $selectPPV_No
                    if ($stmt2->execute()) {
                        $ppvData = $stmt2->fetch(PDO::FETCH_ASSOC);

                        if ($ppvData && $Name && $Email) {
                            // Extract the relevant values from $ppvData
                            $Requested_Date = $ppvData['Date_Received'];
                            $Requestor = $ppvData['Requestor'];
                            $Project = $ppvData['Project'];
                            $PN = $ppvData['Delta_PN'];
                            $SAP_PN = $ppvData['SAP_PN'];
                            $Description = $ppvData['Description'];
                            $QPA = $ppvData['QPA'];
                            $PR_Qty = $ppvData['PR_Qty'];
                            $UoM = $ppvData['UoM'];
                            $Prev_Price = $ppvData['Prev_Price'];
                            $PPV_Type = $ppvData['PPV_Type'];
                            $CVendor = $ppvData['Current_Vendor'];
                            $New_Price1 = $ppvData['New_Price_1'];
                            $Currency1 = $ppvData['Currency_1'];
                            $LT1 = $ppvData['LT_1'];
                            $SPQ1 = $ppvData['SPQ_1'];
                            $MOQ1 = $ppvData['MOQ_1'];
                            $Qty2P2V1 = $ppvData['Qty2PurchasetoVendor_1'];
                            $Total_Amt1 = $ppvData['Total_Amt_1'];
                            $New_Vendor = $ppvData['New_Vendor'];
                            $New_Price2 = $ppvData['New_Price_2'];
                            $Currency2 = $ppvData['Currency_2'];
                            $LT2 = $ppvData['LT_2'];
                            $SPQ2 = $ppvData['SPQ_2'];
                            $MOQ2 = $ppvData['MOQ_2'];
                            $Qty2P2V2 = $ppvData['Qty2PurchasetoVendor_2'];
                            $Total_Amt2 = $ppvData['Total_Amt_2'];
                            $Purchase_Recom = $ppvData['Purchasing_Recom'];
                            $BC_Recomm = $ppvData['bc_recomm'];
                            $Approver_Name_1 = $ppvData['Approver_Name_1'];
                            $DisApprover_Name = $ppvData['DisApprover_Name'];
                            $ApvCheck1 = isset($ppvData['Approver_Check_1']) ? $ppvData['Approver_Check_1'] : false;
                            $DisApproved = isset($ppvData['DisApproved']) ? $ppvData['DisApproved'] : false;

                            $Approver_Name = [
                                'Approved' => [$ApvCheck1 ? $Approver_Name_1 : ''],
                                'Disapproved' => $DisApproved ? $DisApprover_Name : '',
                            ];

                            $Request_Status = $ppvData['Request_Status'];
                            $Date_Approved = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_1']));
                            $Remarks = $ppvData['Remarks'];
                            $attachment = '';

                            // Call writeExcel function with the retrieved data
                            $excel_msg = writeExcel($No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price, $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor, $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recom, $BC_Recomm, $Approver_Name, [$Date_Approved], $Remarks);

                            if ($excel_msg) {
                                // Define the directory where PDF files are stored
                                $pdfDirectory = 'C:\\xampp\\htdocs\\ATS\\ATSBC_PORTAL\\data_files\\pdf';

                                // Construct the PDF file path based on $Requestor and $No
                                $pdfPath = $pdfDirectory . "\\PPV($Requestor)($No).pdf";

                                // Check if the PDF file exists
                                if (file_exists($pdfPath)) {
                                    // The PDF file exists, and you can work with it here
                                    $attachment = $pdfPath;
                                } else {
                                    // The PDF file does not exist
                                    echo "PDF file not found at: $pdfPath";
                                }
                            } else {
                                // Handle the case where Excel is not available
                                echo 'Error: Microsoft Excel is not available.';
                            }

                            $subject = "Your PPV Request is $Request_Status!";
                            $body = "Item Request No.$No in ATS Business Control Portal has been $Request_Status by Approver 1.<br> Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. Thank you! <br><i>***This is an auto generated message, please do not reply***<i>";

                            $message = sendEmail($Name, $Email, $subject, $body, $attachment);

                            $response = [
                                'success' => true,
                                'message' => $message
                            ];
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Failed to submit!, Please contact the admin. Thanks!'
                            ];
                        }
                    } else {
                        echo "Query execution failed for $selectPPV_No";
                    }
                } else {
                    echo "No records found for No: $No";
                }
            } else {
                echo "Query execution failed";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['nxtApv'])) {
        // $Qbom_Price = isset($_POST['Variance_VS_QBOM_Price']) ? $_POST['Variance_VS_QBOM_Price'] : 0;
        // $Approver = ($_POST['Approver'] === 'Approver 3') ? 'Approver 2' : 'Approver 3';
        $Approver = $_POST['Approver'];
        $No = $_POST['No'];

        try {

            $selectPPVSql = "SELECT u.name, u.email FROM ppv p LEFT JOIN users u ON p.Approver = u.role WHERE p.No = :No";

            $stmt1 = $pdo->prepare($selectPPVSql);
            if (!$stmt1) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt1->bindParam(':No', $No);

            if ($stmt1->execute()) {
                $row = $stmt1->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    $Name = $row['name'];
                    $Email = $row['email'];

                    if ($Name && $Email) {
                        $subject = "For Approval";
                        $body = "Item Request No.$No in ATS Business Control Portal has been approved by Approver 1.<br> Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. 
                Thank you! <br><i>***This is an auto generated message, please do not reply***<i>";

                        $message = sendEmail($Name, $Email, $subject, $body);
                        $msg = ($message !== "Email has been Sent!") ? "Email not sent!" : "Email has been Sent!";

                        $response = [
                            'success' => true,
                            'message' => $msg,
                            'redirect' => 'bc_dashboard.php'
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Failed to submit Remarks!, Please contact the admin. Thanks!'
                        ];
                    }
                } else {
                    echo "No records found for No: $No";
                }
            } else {
                echo "Query execution failed";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['apv2'])) {
        $Approver = $_POST['approver'];
        $varianceQbom = isset($_POST['varianceQbom']) ? $_POST['varianceQbom'] : 0;
        $NxtApv = ($varianceQbom > 3000) ? 'Approver 3' : 'Approver 2';
        $Status = ($varianceQbom > 3000) ? 'IN-PROCESS' : 'DONE';
        $Request_Status = $_POST['request_status'];
        $No = $_POST['nO'];
        $ApvCheck2 = isset($_POST['approvedCheck2']) ? $_POST['approvedCheck2'] : false;
        $ApvBy2 = $ApvCheck2 ? $_POST['approvedBy2'] : '';
        $date_2 = $_POST['date2'];
        $DApvCheck = isset($_POST['disapproved']) ? $_POST['disapproved'] : false;
        $DApv = $_POST['disapproved_by'];

        $datetime = DateTime::createFromFormat('m/d/Y, h:i:s A', $date_2);
        $mysqlDate2 = $datetime->format('Y-m-d H:i:s');

        try {
            $updateApvSql = "UPDATE ppv SET Approver_Check_2 = :ApvCheck2, Approver_Name_2 = :ApvBy2, Date_Approved_2 = :date_2, DisApproved = :DApvCheck, DisApprover_Name = :DApv, Approver = :Approver, Request_Status = :Request_Status, Status = :Status WHERE No = :No";
            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':ApvCheck2', $ApvCheck2);
            $stmt->bindParam(':ApvBy2', $ApvBy2);
            $stmt->bindParam(':date_2', $mysqlDate2);
            $stmt->bindParam(':DApvCheck', $DApvCheck);
            $stmt->bindParam(':DApv', $DApv);
            $stmt->bindParam(':Approver', $NxtApv);
            $stmt->bindParam(':Request_Status', $Request_Status);
            $stmt->bindParam(':Status', $Status);
            $stmt->bindParam(':No', $No);

            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'Form has been submitted!'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit form! Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            $response = [
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }

        // GET THE REQUESTOR NAME, EMAIL
        try {
            $selectPPVSql = "SELECT u.name, u.email FROM ppv p LEFT JOIN users u ON p.Requestor = u.name WHERE p.No =:No;";
            $stmt = $pdo->prepare($selectPPVSql);

            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }

            $stmt->bindParam(':No', $No);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $Name = $row['name'];
                    $Email = $row['email'];
                } else {
                    echo "No records found for No: $No";
                }
            } else {
                echo "Query execution failed";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

        if ($NxtApv === "Approver 2") {
            try {

                $selectPPV_No = "SELECT * FROM ppv WHERE No =:No;";

                $stmt = $pdo->prepare($selectPPV_No);

                if (!$stmt) {
                    die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
                }

                $stmt->bindParam(':No', $No);
                // Fetch the data for $selectPPV_No
                if ($stmt->execute()) {
                    $ppvData = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($ppvData && $Name && $Email) {
                        // Extract the relevant values from $ppvData
                        $Requested_Date = $ppvData['Date_Received'];
                        $Requestor = $ppvData['Requestor'];
                        $Project = $ppvData['Project'];
                        $PN = $ppvData['Delta_PN'];
                        $SAP_PN = $ppvData['SAP_PN'];
                        $Description = $ppvData['Description'];
                        $QPA = $ppvData['QPA'];
                        $PR_Qty = $ppvData['PR_Qty'];
                        $UoM = $ppvData['UoM'];
                        $Prev_Price = $ppvData['Prev_Price'];
                        $PPV_Type = $ppvData['PPV_Type'];
                        $CVendor = $ppvData['Current_Vendor'];
                        $New_Price1 = $ppvData['New_Price_1'];
                        $Currency1 = $ppvData['Currency_1'];
                        $LT1 = $ppvData['LT_1'];
                        $SPQ1 = $ppvData['SPQ_1'];
                        $MOQ1 = $ppvData['MOQ_1'];
                        $Qty2P2V1 = $ppvData['Qty2PurchasetoVendor_1'];
                        $Total_Amt1 = $ppvData['Total_Amt_1'];
                        $New_Vendor = $ppvData['New_Vendor'];
                        $New_Price2 = $ppvData['New_Price_2'];
                        $Currency2 = $ppvData['Currency_2'];
                        $LT2 = $ppvData['LT_2'];
                        $SPQ2 = $ppvData['SPQ_2'];
                        $MOQ2 = $ppvData['MOQ_2'];
                        $Qty2P2V2 = $ppvData['Qty2PurchasetoVendor_2'];
                        $Total_Amt2 = $ppvData['Total_Amt_2'];
                        $Purchase_Recom = $ppvData['Purchasing_Recom'];
                        $BC_Recomm = $ppvData['bc_recomm'];
                        $Approver_Name_1 = $ppvData['Approver_Name_1'];
                        $Approver_Name_2 = $ppvData['Approver_Name_2'];
                        $Approver_Name_3 = $ppvData['Approver_Name_3'];
                        $DisApprover_Name = $ppvData['DisApprover_Name'];
                        $Date_Approved1 = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_1']));
                        $Date_Approved2 = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_2']));
                        $Remarks = $ppvData['Remarks'];
                        $ApvCheck1 = isset($ppvData['Approver_Check_1']) ? $ppvData['Approver_Check_1'] : false;
                        $ApvCheck2 = isset($ppvData['Approver_Check_2']) ? $ppvData['Approver_Check_2'] : false;
                        $ApvCheck3 = isset($ppvData['Approver_Check_3']) ? $ppvData['Approver_Check_3'] : false;
                        $DisApproved = isset($ppvData['DisApproved']) ? $ppvData['DisApproved'] : false;

                        $Approver_Name = [
                            'Approved' => [
                                $ApvCheck1 ? $Approver_Name_1 : '',
                                $ApvCheck2 ? $Approver_Name_2 : '',
                                $ApvCheck3 ? $Approver_Name_3 : '',
                            ],
                            'Disapproved' => $DisApproved ? $DisApprover_Name : '',
                        ];

                        $attachment = '';
                        // echo '<pre>';
                        // var_dump($Approver_Name);
                        // echo '</pre>';
                        // Call writeExcel function with the retrieved data
                        $excel_msg = writeExcel($No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price, $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor, $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recom, $BC_Recomm, $Approver_Name, [$Date_Approved1, $Date_Approved2], $Remarks);

                        if ($excel_msg) {
                            // Define the directory where PDF files are stored
                            $pdfDirectory = 'C:\\xampp\\htdocs\\ATS\\ATSBC_PORTAL\\data_files\\pdf';

                            // Construct the PDF file path based on $Requestor and $No
                            $pdfPath = $pdfDirectory . "\\PPV($Requestor)($No).pdf";

                            // Check if the PDF file exists
                            if (file_exists($pdfPath)) {
                                // The PDF file exists, and you can work with it here
                                $attachment = $pdfPath;
                            } else {
                                // The PDF file does not exist
                                echo "PDF file not found at: $pdfPath";
                            }
                        } else {
                            // Handle the case where Excel is not available
                            echo 'Error: Microsoft Excel is not available.';
                        }

                        $subject = "Your PPV Request is $Request_Status!";
                        $body = "Item Request No.$No in ATS Business Control Portal has been $Request_Status by $NxtApv.<br> Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. Thank you! <br><i>***This is an auto generated message, please do not reply***<i>";

                        $message = sendEmail($Name, $Email, $subject, $body, $attachment);

                        $response = [
                            'success' => true,
                            'message' => $message
                        ];
                    } else {
                        $response = 'Failed to submit!, Please contact the admin. Thanks!';
                    }
                } else {
                    echo "Query execution failed";
                }
            } catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        } else {
            $response = [
                'success' => true,
                'message' => 'Form submitted to next approver'
            ];
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['apv3'])) {
        $Approver = $_POST['approver'];
        $Status = 'DONE';
        $Request_Status = $_POST['request_status'];
        $No = $_POST['nO'];
        $ApvCheck3 = isset($_POST['approvedCheck3']) ? $_POST['approvedCheck3'] : false;
        $ApvBy3 = $ApvCheck3 ? $_POST['approvedBy3'] : '';
        $date_3 = $_POST['date3'];
        $DApvCheck = isset($_POST['disapproved']) ? $_POST['disapproved'] : false;
        $DApv = $_POST['disapproved_by'];

        $datetime = DateTime::createFromFormat('m/d/Y, h:i:s A', $date_3);
        $mysqlDate3 = $datetime->format('Y-m-d H:i:s');

        try {
            $updateApvSql = "UPDATE ppv SET Approver_Check_3 = :ApvCheck3, Approver_Name_3 = :ApvBy3, Date_Approved_3 = :date_3, DisApproved = :DApvCheck, DisApprover_Name = :DApv, Request_Status = :Request_Status, Status = :Status WHERE No = :No";
            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':ApvCheck3', $ApvCheck3);
            $stmt->bindParam(':ApvBy3', $ApvBy3);
            $stmt->bindParam(':date_3', $mysqlDate3);
            $stmt->bindParam(':DApvCheck', $DApvCheck);
            $stmt->bindParam(':DApv', $DApv);
            $stmt->bindParam(':Request_Status', $Request_Status);
            $stmt->bindParam(':Status', $Status);
            $stmt->bindParam(':No', $No);

            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'Form has been submitted!'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit form! Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            $response = [
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ];
        }

        // GET THE REQUESTOR NAME, EMAIL
        try {
            $selectPPVSql = "SELECT u.name, u.email FROM ppv p LEFT JOIN users u ON p.Requestor = u.name WHERE p.No =:No;";
            $stmt = $pdo->prepare($selectPPVSql);

            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }

            $stmt->bindParam(':No', $No);
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $Name = $row['name'];
                    $Email = $row['email'];
                } else {
                    echo "No records found for No: $No";
                }
            } else {
                echo "Query execution failed";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

        try {

            $selectPPV_No = "SELECT * FROM ppv WHERE No =:No;";

            $stmt = $pdo->prepare($selectPPV_No);

            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }

            $stmt->bindParam(':No', $No);
            // Fetch the data for $selectPPV_No
            if ($stmt->execute()) {
                $ppvData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($ppvData && $Name && $Email) {
                    // Extract the relevant values from $ppvData
                    $Requested_Date = $ppvData['Date_Received'];
                    $Requestor = $ppvData['Requestor'];
                    $Project = $ppvData['Project'];
                    $PN = $ppvData['Delta_PN'];
                    $SAP_PN = $ppvData['SAP_PN'];
                    $Description = $ppvData['Description'];
                    $QPA = $ppvData['QPA'];
                    $PR_Qty = $ppvData['PR_Qty'];
                    $UoM = $ppvData['UoM'];
                    $Prev_Price = $ppvData['Prev_Price'];
                    $PPV_Type = $ppvData['PPV_Type'];
                    $CVendor = $ppvData['Current_Vendor'];
                    $New_Price1 = $ppvData['New_Price_1'];
                    $Currency1 = $ppvData['Currency_1'];
                    $LT1 = $ppvData['LT_1'];
                    $SPQ1 = $ppvData['SPQ_1'];
                    $MOQ1 = $ppvData['MOQ_1'];
                    $Qty2P2V1 = $ppvData['Qty2PurchasetoVendor_1'];
                    $Total_Amt1 = $ppvData['Total_Amt_1'];
                    $New_Vendor = $ppvData['New_Vendor'];
                    $New_Price2 = $ppvData['New_Price_2'];
                    $Currency2 = $ppvData['Currency_2'];
                    $LT2 = $ppvData['LT_2'];
                    $SPQ2 = $ppvData['SPQ_2'];
                    $MOQ2 = $ppvData['MOQ_2'];
                    $Qty2P2V2 = $ppvData['Qty2PurchasetoVendor_2'];
                    $Total_Amt2 = $ppvData['Total_Amt_2'];
                    $Purchase_Recom = $ppvData['Purchasing_Recom'];
                    $BC_Recomm = $ppvData['bc_recomm'];
                    $Approver_Name_1 = $ppvData['Approver_Name_1'];
                    $Approver_Name_2 = $ppvData['Approver_Name_2'];
                    $Approver_Name_3 = $ppvData['Approver_Name_3'];
                    $DisApprover_Name = $ppvData['DisApprover_Name'];
                    $Date_Approved1 = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_1']));
                    $Date_Approved2 = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_2']));
                    $Date_Approved3 = date("m/d/y h:ia", strtotime($ppvData['Date_Approved_3']));
                    $Remarks = $ppvData['Remarks'];
                    $ApvCheck1 = isset($ppvData['Approver_Check_1']) ? $ppvData['Approver_Check_1'] : false;
                    $ApvCheck2 = isset($ppvData['Approver_Check_2']) ? $ppvData['Approver_Check_2'] : false;
                    $ApvCheck3 = isset($ppvData['Approver_Check_3']) ? $ppvData['Approver_Check_3'] : false;
                    $DisApproved = isset($ppvData['DisApproved']) ? $ppvData['DisApproved'] : false;

                    $Approver_Name = [
                        'Approved' => [
                            $ApvCheck1 ? $Approver_Name_1 : '',
                            $ApvCheck2 ? $Approver_Name_2 : '',
                            $ApvCheck3 ? $Approver_Name_3 : '',
                        ],
                        'Disapproved' => $DisApproved ? $DisApprover_Name : '',
                    ];

                    $attachment = '';
                    // echo '<pre>';
                    // var_dump($Approver_Name);
                    // echo '</pre>';
                    // Call writeExcel function with the retrieved data
                    $excel_msg = writeExcel($No, $Requested_Date, $Requestor, $Project, $PN, $SAP_PN, $Description, $QPA, $PR_Qty, $UoM, $Prev_Price, $PPV_Type, $CVendor, $New_Price1, $Currency1, $LT1, $SPQ1, $MOQ1, $Qty2P2V1, $Total_Amt1, $New_Vendor, $New_Price2, $Currency2, $LT2, $SPQ2, $MOQ2, $Qty2P2V2, $Total_Amt2, $Purchase_Recom, $BC_Recomm, $Approver_Name, [$Date_Approved1, $Date_Approved2, $Date_Approved3], $Remarks);

                    if ($excel_msg) {
                        // Define the directory where PDF files are stored
                        $pdfDirectory = 'C:\\xampp\\htdocs\\ATS\\ATSBC_PORTAL\\data_files\\pdf';

                        // Construct the PDF file path based on $Requestor and $No
                        $pdfPath = $pdfDirectory . "\\PPV($Requestor)($No).pdf";

                        // Check if the PDF file exists
                        if (file_exists($pdfPath)) {
                            // The PDF file exists, and you can work with it here
                            $attachment = $pdfPath;
                        } else {
                            // The PDF file does not exist
                            echo "PDF file not found at: $pdfPath";
                        }
                    } else {
                        // Handle the case where Excel is not available
                        echo 'Error: Microsoft Excel is not available.';
                    }

                    $subject = "Your PPV Request is $Request_Status!";
                    $body = "Item Request No.$No in ATS Business Control Portal has been $Request_Status by EVP.<br> Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. Thank you! <br><i>***This is an auto generated message, please do not reply***<i>";

                    $message = sendEmail($Name, $Email, $subject, $body, $attachment);

                    $response = [
                        'success' => true,
                        'message' => $message
                    ];
                } else {
                    $response = 'Failed to submit!, Please contact the admin. Thanks!';
                }
            } else {
                echo "Query execution failed";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

        echo json_encode($response);
        exit();
    } elseif (isset($_POST['view'])) {
        $No = $_POST['no'];
        $Status = $_POST['status'];
        $Apv_Name = $_POST['name'];
        $Apv_Role = $_POST['role'];


        try {
            // Set the appropriate column name based on the role
            $approverColumnName = ($Apv_Role === 'Approver 1') ? 'Approver_Name_1' : (($Apv_Role === 'Approver 2') ? 'Approver_Name_2' : 'Approver_Name_3');

            $updateApvSql = "UPDATE ppv SET Status = :status, $approverColumnName = :Name, Approver = :Role WHERE No = :No";
            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':status', $Status);
            $stmt->bindParam(':No', $No);
            $stmt->bindParam(':Name', $Apv_Name);
            $stmt->bindParam(':Role', $Apv_Role);
            // Return the result as JSON response
            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'No ' . $No . ' has been tagged by Approver ' . $Apv_Name
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to tag No!, Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['return'])) {
        $No = $_POST['No'];
        $Status = null;

        try {

            $updateApvSql = "UPDATE ppv SET Status = :status, Approver_Name_1 = NULL WHERE No = :No";
            $stmt = $pdo->prepare($updateApvSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':status', $Status);
            $stmt->bindParam(':No', $No);
            // Return the result as JSON response
            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => 'No ' . $No . ' has been returned by Approver 1'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to return Request No ' . $No . ', Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } else {
        echo "Error: Command not available, Please contact administrator.";
    }
}
