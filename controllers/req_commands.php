<?php require_once 'db.php';
include_once 'send_email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $date = $_POST['date'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $proj = $_POST['projects'];
        $SAP_No = $_POST['SAP_No'];
        $Delta_PN = $_POST['Delta_PN'];
        $desc = $_POST['desc'];
        $QPA = $_POST['QPA'];
        $PR_Qty = $_POST['PR_Qty'];
        $Purchase_Qty = $_POST['Purchase_Qty'];
        $UOM = $_POST['UOM'];
        $Prev_price = $_POST['Prev_price'];
        $Currency = $_POST['Currency'];
        $PPV_Type = $_POST['PPV_Type'];
        $other_ppv_type = $_POST['other_ppv_type'];
        // VENDOR 1 
        $Current_Vendor = $_POST['Current_Vendor'];
        $Current_Vendor_Price = $_POST['Current_Vendor_Price'];
        $Currency1 = $_POST['Currency1'];
        $LT1 = $_POST['LT1'];
        $SPQ1 = $_POST['SPQ1'];
        $MOQ1 = $_POST['MOQ1'];
        $Qty_to_Purchase_from_Vendor_1 = $_POST['Qty_to_Purchase_from_Vendor_1'];
        $Total_Amt_1 = $_POST['Total_Amt_1'];
        // VENDOR 2
        $New_Vendor = $_POST['New_Vendor'] ?? null;
        $New_Vendor_Price = $_POST['New_Vendor_Price'] ?? null;
        $Currency2 = $_POST['Currency2'] ?? null;
        $LT2 = $_POST['LT2'] ?? null;
        $SPQ2 = $_POST['SPQ2'] ?? null;
        $MOQ2 = $_POST['MOQ2'] ?? null;
        $Qty_to_Purchase_from_Vendor_2 = $_POST['Qty_to_Purchase_from_Vendor_2'] ?? null;
        $Total_Amt_2 = $_POST['Total_Amt_2'] ?? null;
        $Reason = $_POST['Reason'] ?? null;
        $Purchasing_Recom = $_POST['Purchasing_Recom'] ?? null;

        $For_Approver_1 = "Approver 1";

        try {
            $insertReqSql = "INSERT INTO ppv (Date_Received,Requestor,Project,SAP_PN,Delta_PN,Description,QPA,PR_Qty,Purchase_Qty,UoM,Prev_Price,Currency,PPV_Type,other_ppv_type,Current_Vendor,New_Price_1,Currency_1,LT_1,SPQ_1,MOQ_1,Qty2PurchasetoVendor_1,Total_Amt_1,reason,New_Vendor,New_Price_2,Currency_2,LT_2,SPQ_2,MOQ_2,Qty2PurchasetoVendor_2,Total_Amt_2,Purchasing_Recom,Approver) VALUES (:date,:name,:proj,:sap_no,:delta_no,:desc,:QPA,:PR_Qty,:Purchase_Qty,:UOM,:Prev_price,:Currency,:PPV_Type,:other_ppv_type,:Current_Vendor,:Current_Vendor_Price,:Currency1,:LT1,:SPQ1,:MOQ1,:Qty_to_Purchase_from_Vendor_1,:Total_Amt_1,:Reason,:New_Vendor,:New_Vendor_Price,:Currency2,:LT2,:SPQ2,:MOQ2,:Qty_to_Purchase_from_Vendor_2,:Total_Amt_2,:Purchasing_Recom,:For_Approver_1)";

            $stmt = $pdo->prepare($insertReqSql);
            if (!$stmt) {
                die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
            }
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':proj', $proj);
            $stmt->bindParam(':sap_no', $SAP_No);
            $stmt->bindParam(':delta_no', $Delta_PN);
            $stmt->bindParam(':desc', $desc);
            $stmt->bindParam(':QPA', $QPA);
            $stmt->bindParam(':PR_Qty', $PR_Qty);
            $stmt->bindParam(':Purchase_Qty', $Purchase_Qty);
            $stmt->bindParam(':UOM', $UOM);
            $stmt->bindParam(':Prev_price', $Prev_price);
            $stmt->bindParam(':Currency', $Currency);
            $stmt->bindParam(':PPV_Type', $PPV_Type);
            $stmt->bindParam(':other_ppv_type', $other_ppv_type);
            // vendor 1
            $stmt->bindParam(':Current_Vendor', $Current_Vendor);
            $stmt->bindParam(':Current_Vendor_Price', $Current_Vendor_Price);
            $stmt->bindParam(':Currency1', $Currency1);
            $stmt->bindParam(':LT1', $LT1);
            $stmt->bindParam(':SPQ1', $SPQ1);
            $stmt->bindParam(':MOQ1', $MOQ1);
            $stmt->bindParam(':Qty_to_Purchase_from_Vendor_1', $Qty_to_Purchase_from_Vendor_1);
            $stmt->bindParam(':Total_Amt_1', $Total_Amt_1);
            // vendor 2
            $stmt->bindParam(':New_Vendor', $New_Vendor);
            $stmt->bindParam(':New_Vendor_Price', $New_Vendor_Price);
            $stmt->bindParam(':Currency2', $Currency2);
            $stmt->bindParam(':LT2', $LT2);
            $stmt->bindParam(':SPQ2', $SPQ2);
            $stmt->bindParam(':MOQ2', $MOQ2);
            $stmt->bindParam(':Qty_to_Purchase_from_Vendor_2', $Qty_to_Purchase_from_Vendor_2);
            $stmt->bindParam(':Total_Amt_2', $Total_Amt_2);
            $stmt->bindParam(':Reason', $Reason);
            $stmt->bindParam(':Purchasing_Recom', $Purchasing_Recom);
            $stmt->bindParam(':For_Approver_1', $For_Approver_1);

            if ($stmt->execute()) {
                // GET THE APPROVER NAMES AND EMAILS
                try {
                    $selectApvSql = "SELECT name, email FROM users WHERE role ='Approver 1';";
                    $stmt = $pdo->prepare($selectApvSql);

                    if (!$stmt) {
                        die('Error preparing SQL statement: ' . $pdo->errorInfo()[2]);
                    }

                    if ($stmt->execute()) {
                        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($rows) {
                            // Access each row in the result set
                            foreach ($rows as $row) {
                                $Name = $row['name'];
                                $Email = $row['email'];

                                $subject = "New PPV Request from $name";
                                $body = "To check the PPV Request, Please log in to <a href='http://192.168.6.144/ATS/ATSBC_PORTAL/view/bc_login.php'>ATS Business Control Portal</a> to review it. Thank you! <br><i>***This is an auto-generated message, please do not reply***<i>";

                                $message = sendEmail($Name, $Email, $subject, $body);
                                $msg = ($message !== "Email has been Sent!") ? "Email not sent!" : "Email has been Sent!";
                            }
                        } else {
                            echo "No name and email of role Approver 1";
                        }
                    } else {
                        echo "Query execution failed";
                    }
                } catch (PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                }

                $response = [
                    'success' => true,
                    'message' => 'Your request for PPV was successfully submitted for approval.',
                    'redirect' => 'pur_dashboard.php'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to submit Request Form!, Please contact the admin. Thanks!'
                ];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        echo json_encode($response);
        exit();
    } elseif (isset($_POST['delete'])) {
        $No = $_POST['No'];

        try {
            $select_sql = "DELETE FROM ppv WHERE No = :No";
            $stmt_select = $pdo->prepare($select_sql);
            $stmt_select->bindParam(':No', $No, PDO::PARAM_STR);
            $stmt_select->execute();

            $response = [
                'success' => true,
                'message' => 'Request Deleted Successfully'
            ];
        } catch (PDOException $e) {
            // Handle the exception, and send an error response
            $response = [
                'success' => false,
                'message' => 'Error deleting record: ' . $e->getMessage()
            ];
        }

        echo json_encode($response);
        exit();
    } else {
    }
} else {
    echo "not a post";
}
