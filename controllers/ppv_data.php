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
}
