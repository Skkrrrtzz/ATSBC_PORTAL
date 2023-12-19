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
