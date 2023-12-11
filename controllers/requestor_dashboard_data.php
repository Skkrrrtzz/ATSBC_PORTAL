<?php
include_once 'db.php';
if ($Position !== "Manager") {
    // Define the conditions for pending, approved, and disapproved records
    $pendingCondition = "Requestor = :requestor AND (Status = 'IN-PROCESS' OR Request_Status IS NULL);";
    $approvedCondition = "Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Approved'";
    $disapprovedCondition = "Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Disapproved'";
} else {
    // Define the conditions for pending, approved, and disapproved records
    $pendingCondition = "(Status = 'IN-PROCESS' OR Request_Status IS NULL);";
    $approvedCondition = "Status = 'DONE' AND Request_Status = 'Approved'";
    $disapprovedCondition = "Status = 'DONE' AND Request_Status = 'Disapproved'";
}

// Query the database with the appropriate condition for pending records
if (!empty($pendingCondition)) {
    $sql_pending = "SELECT * FROM `ppv` WHERE $pendingCondition";
    $stmt_pending = $pdo->prepare($sql_pending);
    if ($Position !== "Manager") {
        $stmt_pending->bindParam(':requestor', $Name, PDO::PARAM_STR);
    }
    $stmt_pending->execute();
    $pending = $stmt_pending->rowCount();
    $pendingResult = $stmt_pending->fetchAll(PDO::FETCH_ASSOC);
} else {
    $pending = 0;
    $pendingResult = [];
}

// Query the database with the appropriate condition for approved records
if (!empty($approvedCondition)) {
    $sql_approved = "SELECT * FROM `ppv` WHERE $approvedCondition";
    $stmt_approved = $pdo->prepare($sql_approved);
    if ($Position !== "Manager") {
        $stmt_approved->bindParam(':requestor', $Name, PDO::PARAM_STR);
    }
    $stmt_approved->execute();
    $approved = $stmt_approved->rowCount();
    $approvedResult = $stmt_approved->fetchAll(PDO::FETCH_ASSOC);
} else {
    $approved = 0;
    $approvedResult = [];
}

// Query the database with the appropriate condition for disapproved records
if (!empty($disapprovedCondition)) {
    $sql_disapproved = "SELECT * FROM `ppv` WHERE $disapprovedCondition";
    $stmt_disapproved = $pdo->prepare($sql_disapproved);
    if ($Position !== "Manager") {
        $stmt_disapproved->bindParam(':requestor', $Name, PDO::PARAM_STR);
    }
    $stmt_disapproved->execute();
    $disapproved = $stmt_disapproved->rowCount();
    $disapprovedResult = $stmt_disapproved->fetchAll(PDO::FETCH_ASSOC);
} else {
    $disapproved = 0;
    $disapprovedResult = [];
}

// // Define the conditions for pending and approved records
// $pendingCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND (Status = 'IN-PROCESS' OR Status IS NULL)";
// $approvedCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Approved'";
// $disapprovedCondition = "SELECT * FROM `ppv` WHERE Requestor = :requestor AND Status = 'DONE' AND Request_Status = 'Disapproved'";
// // Prepare and execute the query for pending records
// $stmt_pending = $pdo->prepare($pendingCondition);
// $stmt_pending->bindParam(':requestor', $Name, PDO::PARAM_STR);
// $stmt_pending->execute();
// $pending = $stmt_pending->rowCount();
// $pendingResult = $stmt_pending->fetchAll(PDO::FETCH_ASSOC);

// // Prepare and execute the query for approved records
// $stmt_approved = $pdo->prepare($approvedCondition);
// $stmt_approved->bindParam(':requestor', $Name, PDO::PARAM_STR);
// $stmt_approved->execute();
// $approved = $stmt_approved->rowCount();
// $approvedResult = $stmt_approved->fetchAll(PDO::FETCH_ASSOC);

// // Prepare and execute the query for disapproved records
// $stmt_disapproved = $pdo->prepare($disapprovedCondition);
// $stmt_disapproved->bindParam(':requestor', $Name, PDO::PARAM_STR);
// $stmt_disapproved->execute();
// $disapproved = $stmt_disapproved->rowCount();
// $disapprovedResult = $stmt_disapproved->fetchAll(PDO::FETCH_ASSOC);
