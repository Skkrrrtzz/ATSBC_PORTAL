<?php
include_once 'db.php';
// Define the conditions for pending and approved records
$pendingCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND (Status = 'IN-PROCESS' OR Status IS NULL)";
$approvedCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Approved'";
$disapprovedCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Disapproved'";
// Prepare and execute the query for pending records
$stmt_pending = $pdo->prepare($pendingCondition);
$stmt_pending->bindParam(':requestor', $Name, PDO::PARAM_STR);
$stmt_pending->execute();
$pending = $stmt_pending->rowCount();
$pendingResult = $stmt_pending->fetchAll(PDO::FETCH_ASSOC);

// Prepare and execute the query for approved records
$stmt_approved = $pdo->prepare($approvedCondition);
$stmt_approved->bindParam(':requestor', $Name, PDO::PARAM_STR);
$stmt_approved->execute();
$approved = $stmt_approved->rowCount();
$approvedResult = $stmt_approved->fetchAll(PDO::FETCH_ASSOC);

// Prepare and execute the query for disapproved records
$stmt_disapproved = $pdo->prepare($disapprovedCondition);
$stmt_disapproved->bindParam(':requestor', $Name, PDO::PARAM_STR);
$stmt_disapproved->execute();
$disapproved = $stmt_disapproved->rowCount();
$disapprovedResult = $stmt_disapproved->fetchAll(PDO::FETCH_ASSOC);

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

        // Return data as JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'No data found for this No.']);
    }
    exit();
}
