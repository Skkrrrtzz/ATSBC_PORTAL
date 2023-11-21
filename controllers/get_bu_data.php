<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Prepare and execute the SQL query using PDO
    $sql = "SELECT * FROM bu";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // Fetch data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Return data as JSON response
    echo json_encode($data);
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if SAP_No is provided in the POST request
    if (isset($_POST['sapNo'])) {
        $sapNo = $_POST['sapNo'];

        // Prepare SQL query to select Delta_PN and Description based on SAP_No
        $selectSql = "SELECT Item_No, Item_Description,Foreign_Name FROM bu WHERE Item_No = :sapNo";
        $stmt = $pdo->prepare($selectSql);
        $stmt->bindParam(':sapNo', $sapNo);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if a result was found
        if ($result) {
            // Return the result as JSON response
            echo json_encode([
                'success' => true,
                'deltaPN' => $result['Foreign_Name'],
                'description' => $result['Item_Description']
            ]);
        } else {
            // Return an error response if no matching SAP_No is found
            echo json_encode([
                'success' => false,
                'message' => 'SAP_No not found.'
            ]);
        }
    } else {
        // Handle the case where SAP_No is not provided in the POST request
        echo json_encode([
            'success' => false,
            'message' => 'SAP_No not provided in the request.'
        ]);
    }
}
