<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['PPV'])) {
        $selectedMonthYear = isset($_POST['selectedMonthYear']) ? $_POST['selectedMonthYear'] : '';

        // Extract year and month from the selectedMonthYear
        list($selectedYear, $selectedMonth) = explode('-', $selectedMonthYear);

        // Adjust the SQL query to include the selected month and year conditions
        $ppv_query = "SELECT Date_Received, project, Currency, PPV_Type, variance_vs_qbomprice 
              FROM ppv 
              WHERE Request_Status='Approved' 
              AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = :selectedYear
              AND MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = :selectedMonth";

        $ppv_result = $pdo->prepare($ppv_query);
        $ppv_result->bindParam(':selectedYear', $selectedYear, PDO::PARAM_INT);
        $ppv_result->bindParam(':selectedMonth', $selectedMonth, PDO::PARAM_INT);
        $ppv_result->execute();

        $ppv = $ppv_result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($ppv);
        // $ppv_query = "SELECT Date_Received, project, Currency, PPV_Type, variance_vs_qbomprice FROM ppv WHERE MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = MONTH(CURDATE()) AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = YEAR(CURDATE()) AND Request_Status='Approved';";
        // //MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = YEAR(CURDATE() - INTERVAL 1 MONTH)
        // $ppv_result = $pdo->prepare($ppv_query);
        // $ppv_result->execute();
        // $ppv = $ppv_result->fetchAll(PDO::FETCH_ASSOC);
        // echo json_encode($ppv);
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
    } elseif (isset($_POST['Charge2Cohu'])) {
        $charge2cohu_query = "SELECT SUM(VarianceChargable2Cohu) AS VC2C,Project FROM ppv WHERE Request_Status='Approved' GROUP BY Project;";
        //MONTH(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(STR_TO_DATE(Date_Received, '%m/%d/%Y')) = YEAR(CURDATE() - INTERVAL 1 MONTH)
        $charge2cohu_result = $pdo->prepare($charge2cohu_query);
        $charge2cohu_result->execute();
        $charge2cohu = $charge2cohu_result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($charge2cohu);
    }
} else {
    echo "Method not allowed";
    http_response_code(405);
    exit();
}
$pdo = null;
