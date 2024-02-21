<?php
include_once 'db.php';
if (isset($_POST['No'])) {
    $No = $_POST['No'];

    $select_sql = "SELECT * FROM ppv WHERE No = :No";
    $stmt_select = $pdo->prepare($select_sql);
    $stmt_select->bindParam(':No', $No, PDO::PARAM_STR);
    $stmt_select->execute();
    $select_result = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($select_result)) {
        // Assuming you have retrieved the data as an associative array ($row)
        $data = $select_result[0];

        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No data found for this No.']);
    }
    exit();
} elseif (isset($_POST['updatePPV']) && isset($_POST['PPVNo'])) {
    // Declare variables
    $No = $_POST['PPVNo'];
    $Date_Updated = $_POST['Date_Updated'];
    $Project = $_POST['Project'];
    $QPA = $_POST['QPA'];
    $PR_Qty = $_POST['PR_Qty'];
    $Purchase_Qty = $_POST['Purchase_Qty'];
    $UoM = $_POST['UoM'];
    $Prev_Price = $_POST['Prev_Price'];
    $Currency = $_POST['Currency'];
    $PPV_Type = $_POST['PPV_Type'];
    // VENDOR 1 
    $Current_Vendor = $_POST['Current_Vendor'];
    $Current_Vendor_Price = $_POST['Current_Vendor_Price'];
    $Currency_1 = $_POST['Currency_1'];
    $LT1 = $_POST['LT1'];
    $SPQ1 = $_POST['SPQ1'];
    $MOQ1 = $_POST['MOQ1'];
    $Qty_to_Purchase_from_Vendor1 = $_POST['Qty_to_Purchase_from_Vendor1'];
    $Total_Amt1 = $_POST['Total_Amt1'];
    // VENDOR 2 
    $New_Vendor = $_POST['New_Vendor'] ?? null;
    $New_Price = $_POST['New_Price'] ?? null;
    $Currency_2 = $_POST['Currency_2'] ?? null;
    $LT2 = $_POST['LT2'] ?? null;
    $SPQ2 = $_POST['SPQ2'] ?? null;
    $MOQ2 = $_POST['MOQ2'] ?? null;
    $Qty_to_Purchase_from_Vendor2 = $_POST['Qty_to_Purchase_from_Vendor2'] ?? null;
    $Total_Amt2 = $_POST['Total_Amt2'] ?? null;
    $Purchasing_Recom = $_POST['Purchasing_Recom'];
    $Reason = $_POST['Reason'];
    $other_ppv_type = $_POST['other_ppv_type'];

    // Update the data in the database
    try {
        $updatePPV_sql = "UPDATE ppv SET Date_Updated = :Date_Updated,Project = :Project, QPA = :QPA, PR_Qty = :PR_Qty, Purchase_Qty = :Purchase_Qty, UoM = :UoM, Prev_Price = :Prev_Price, Currency = :Currency, PPV_Type = :PPV_Type, Current_Vendor = :Current_Vendor, New_Price_1 = :Current_Vendor_Price, Currency_1 = :Currency_1, LT_1 = :LT1, SPQ_1 = :SPQ1, MOQ_1 = :MOQ1, Qty2PurchasetoVendor_1 = :Qty_to_Purchase_from_Vendor1,Total_Amt_1 = :Total_Amt1, New_Vendor = :New_Vendor, New_Price_2 = :New_Price, Currency_2 = :Currency_2, LT_2 = :LT2, SPQ_2 = :SPQ2, MOQ_2 =:MOQ2, Qty2PurchasetoVendor_2 = :Qty_to_Purchase_from_Vendor2, Total_Amt_2 = :Total_Amt2, Purchasing_Recom = :Purchasing_Recom, Reason = :Reason, other_ppv_type = :other_ppv_type WHERE No = :No";

        $stmt = $pdo->prepare($updatePPV_sql);
        $stmt->bindParam(':Date_Updated', $Date_Updated, PDO::PARAM_STR);
        $stmt->bindParam(':Project', $Project, PDO::PARAM_STR);
        $stmt->bindParam(':QPA', $QPA, PDO::PARAM_STR);
        $stmt->bindParam(':PR_Qty', $PR_Qty, PDO::PARAM_STR);
        $stmt->bindParam(':Purchase_Qty', $Purchase_Qty, PDO::PARAM_STR);
        $stmt->bindParam(':UoM', $UoM, PDO::PARAM_STR);
        $stmt->bindParam(':Prev_Price', $Prev_Price, PDO::PARAM_STR);
        $stmt->bindParam(':Currency', $Currency, PDO::PARAM_STR);
        $stmt->bindParam(':PPV_Type', $PPV_Type, PDO::PARAM_STR);

        // VENDOR 1
        $stmt->bindParam(':Current_Vendor', $Current_Vendor, PDO::PARAM_STR);
        $stmt->bindParam(':Current_Vendor_Price', $Current_Vendor_Price, PDO::PARAM_STR);
        $stmt->bindParam(':Currency_1', $Currency_1, PDO::PARAM_STR);
        $stmt->bindParam(':LT1', $LT1, PDO::PARAM_STR);
        $stmt->bindParam(':SPQ1', $SPQ1, PDO::PARAM_STR);
        $stmt->bindParam(':MOQ1', $MOQ1, PDO::PARAM_STR);
        $stmt->bindParam(':Qty_to_Purchase_from_Vendor1', $Qty_to_Purchase_from_Vendor1, PDO::PARAM_STR);
        $stmt->bindParam(':Total_Amt1', $Total_Amt1, PDO::PARAM_STR);
        // VENDOR 2
        $stmt->bindParam(':New_Vendor', $New_Vendor, PDO::PARAM_STR);
        $stmt->bindParam(':New_Price', $New_Price, PDO::PARAM_STR);
        $stmt->bindParam(':Currency_2', $Currency_2, PDO::PARAM_STR);
        $stmt->bindParam(':LT2', $LT2, PDO::PARAM_STR);
        $stmt->bindParam(':SPQ2', $SPQ2, PDO::PARAM_STR);
        $stmt->bindParam(':MOQ2', $MOQ2, PDO::PARAM_STR);
        $stmt->bindParam(':Qty_to_Purchase_from_Vendor2', $Qty_to_Purchase_from_Vendor2, PDO::PARAM_STR);
        $stmt->bindParam(':Total_Amt2', $Total_Amt2, PDO::PARAM_STR);

        $stmt->bindParam(':Purchasing_Recom', $Purchasing_Recom, PDO::PARAM_STR);
        $stmt->bindParam(':Reason', $Reason, PDO::PARAM_STR);
        $stmt->bindParam(':other_ppv_type', $other_ppv_type, PDO::PARAM_STR);
        $stmt->bindParam(':No', $No, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Update was successful
            $response = [
                'success' => true,
                'message' => 'PPV Request No ' . $No . ' updated successfully!'
            ];
        } else {
            // Update failed
            $response = [
                'success' => false,
                'message' => 'Failed to update PPV Request No ' . $No
            ];
        }
    } catch (PDOException $e) {
        // Handle database errors
        $response = [
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ];
    }
    echo json_encode($response);
    exit();
} else {
    $No = $_POST['No'];

    $select_sql = "SELECT  `Project`, `SAP_PN`, `Delta_PN`, `Description`, `QPA`, `PR_Qty`, `Purchase_Qty`, `UoM`, `Prev_Price`, `Currency`, `PPV_Type`, `other_ppv_type`, `Current_Vendor`, `New_Price_1`, `Currency_1`, `LT_1`, `SPQ_1`, `MOQ_1`, `Qty2PurchasetoVendor_1`, `Total_Amt_1`, `reason`, `New_Vendor`, `New_Price_2`, `Currency_2`, `LT_2`, `SPQ_2`, `MOQ_2`, `Qty2PurchasetoVendor_2`, `Total_Amt_2`, `Purchasing_Recom` FROM ppv WHERE No = :No";
    $stmt_select = $pdo->prepare($select_sql);
    $stmt_select->bindParam(':No', $No, PDO::PARAM_STR);
    $stmt_select->execute();
    $select_result = $stmt_select->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($select_result)) {
        // Assuming you have retrieved the data as an associative array ($row)
        $data = $select_result[0];

        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No data found for this No.']);
    }
    exit();
}
