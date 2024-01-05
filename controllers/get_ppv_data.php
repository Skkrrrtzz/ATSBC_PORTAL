<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['PPV'])) {
        $ppv_query = "SELECT Date_Received, project, Currency, PPV_Type, variance_vs_qbomprice FROM ppv WHERE MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = MONTH(CURDATE()) AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = YEAR(CURDATE()) AND Request_Status='Approved';";
        //MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = YEAR(CURDATE() - INTERVAL 1 MONTH)
        $ppv_result = $pdo->prepare($ppv_query);
        $ppv_result->execute();
        $ppv = $ppv_result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($ppv);
    } elseif (isset($_POST['check'])) {
        $deltaPN = $_POST['deltaPN'];
        // Perform a database query to check if a record exists with the given Delta_PN
        $check_deltaPN = "SELECT Delta_PN FROM ppv WHERE Delta_PN = :deltaPN AND Request_Status IN ('Approved', 'Disapproved');";
        $check_result = $pdo->prepare($check_deltaPN);
        $check_result->bindParam(':deltaPN', $deltaPN, PDO::PARAM_STR);
        $check_result->execute();

        $response = array();

        if ($check_result->rowCount() > 0) {
            $response['status'] = 'exists';
            $response['deltaPN'] = $deltaPN;
        } else {
            $response['status'] = 'not_exists';
            $response['deltaPN'] = $deltaPN;
        }

        echo json_encode($response);
    }
} else {
    echo "Method not allowed";
    http_response_code(405);
    exit();
}
$pdo = null;
