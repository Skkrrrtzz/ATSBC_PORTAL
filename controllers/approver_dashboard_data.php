<?php
include_once 'db.php';

//REQUEST/S
if ($Role === 'Approver 1') {
    $pendingCondition = "Approver = 'Approver 1' AND Date_Approved_1 IS NULL";
    $approverCondition = "Approver_Check_1 = 'true'";
    $disapprovedCondition = "DisApproved = 'true'";
} elseif ($Role === 'Approver 2') {
    $pendingCondition = "Approver = 'Approver 2' AND Date_Approved_2 IS NULL AND Status !='DONE'";
    $approverCondition = "Approver_Check_2 = 'true' AND Approver_Name_2 = :Name";
    $disapprovedCondition = "DisApproved = 'true' AND DisApprover_Name = :Name";
} elseif ($Role === 'Approver 3') {
    $pendingCondition = "Approver = 'Approver 3' AND Date_Approved_3 IS NULL";
    $approverCondition = "Approver_Check_3 = 'true' AND Approver_Name_3 = :Name";
    $disapprovedCondition = "DisApproved = 'true' AND DisApprover_Name = :Name";
} elseif ($Role === 'Admin') {
    $pendingCondition = "Approver IN ('Approver 1','Approver 2','Approver 3') AND Date_Approved_1 IS NULL AND Date_Approved_2 IS NULL AND Date_Approved_2 IS NULL AND Date_Approved_3 IS NULL";
    $approverCondition = "Approver_Check_1 = 'true' OR Approver_Check_2 = 'true' OR Approver_Check_3 = 'true'";
    $disapprovedCondition = "DisApproved = 'true'";
} else {
    // Handle the case for other roles or set a default condition if needed
    $pendingCondition = "";
    $approverCondition = "";
    $disapprovedCondition = "";
}

// Query the database with the appropriate condition
if (!empty($pendingCondition)) {
    $sql_dashboard = "SELECT * FROM `ppv` WHERE $pendingCondition";
    $stmt_dashboard = $pdo->prepare($sql_dashboard);
    $stmt_dashboard->execute();
    $pending = $stmt_dashboard->rowCount();
    $pending_result = $stmt_dashboard->fetchAll(PDO::FETCH_ASSOC);
} else {
    $pending = 0;
    $pending_result = [];
}

// Query the database with the appropriate condition
if (!empty($approverCondition)) {
    $sql_aprvd_dashboard = "SELECT * FROM `ppv` WHERE $approverCondition";
    $stmt_aprvd_dashboard = $pdo->prepare($sql_aprvd_dashboard);
    $stmt_aprvd_dashboard->bindParam(':Name', $Name, PDO::PARAM_STR);
    $stmt_aprvd_dashboard->execute();
    $approved = $stmt_aprvd_dashboard->rowCount();
    $approved_result = $stmt_aprvd_dashboard->fetchAll(PDO::FETCH_ASSOC);
} else {
    $approved = 0;
    $approved_result = [];
}

// Query the database with the appropriate condition
if (!empty($disapprovedCondition)) {
    $sql_disaprvd_dashboard = "SELECT * FROM `ppv` WHERE $disapprovedCondition";
    $stmt_disaprvd_dashboard = $pdo->prepare($sql_disaprvd_dashboard);
    $stmt_disaprvd_dashboard->bindParam(':Name', $Name, PDO::PARAM_STR);
    $stmt_disaprvd_dashboard->execute();
    $disapproved = $stmt_disaprvd_dashboard->rowCount();
    $disapproved_result = $stmt_disaprvd_dashboard->fetchAll(PDO::FETCH_ASSOC);
} else {
    $disapproved = 0;
    $disapproved_result = [];
}
