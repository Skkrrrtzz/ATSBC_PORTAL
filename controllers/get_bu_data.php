<?php
require_once 'db.php';
function checkTableQPA($pdo, $table, $deltaPN)
{
    $selectSql = "SELECT QPA_0 FROM $table WHERE Item = :deltaPN";
    $stmt = $pdo->prepare($selectSql);
    $stmt->bindParam(':deltaPN', $deltaPN);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && $row['QPA_0'] !== null) {
        return $row['QPA_0'];
    }

    return null;
}

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
    } elseif (isset($_POST['deltaPN']) && isset($_POST['project'])) {

        $deltaPN = $_POST['deltaPN'];
        $project = $_POST['project'];

        // Define the table name mappings
        $tableMappings = [
            'JLP' => 'jlp_qbom',
            'JLP CABLE' => 'jlpcable_qbom',
            'MTP' => 'mtp_qbom',
            'FLIPPER' => 'flipper_qbom',
            'HIGHMAG' => 'highmag_qbom',
            'IONIZER' => 'ionizer_qbom',
            'RCMTP' => 'rcmtp_qbom',
            'ECLIPSE XTA' => 'eclipse_xta_qbom',
            'JTP' => 'jtp_qbom',
            'OLB' => 'olb_qbom',
            'PNP' => 'pnp_qbom',
            'PNP CABLE' => 'pnpcable_qbom',
            'OLB CABLE' => 'olbcable_qbom',
            'SWAP CABLE' => 'swapcable_qbom',
        ];

        $swapTables = ['SWAP' => ['swap1_qbom', 'swap2_qbom', 'swap3_qbom', 'swap4_qbom', 'swap5_qbom', 'swap6_qbom']];

        $result = null;

        if ($project === "SWAP") {
            foreach ($swapTables['SWAP'] as $swapTable) {
                $result = checkTableQPA($pdo, $swapTable, $deltaPN);
                if ($result !== null) {
                    break;
                }
            }
        } else {
            if (array_key_exists($project, $tableMappings)) {
                $result = checkTableQPA($pdo, $tableMappings[$project], $deltaPN);
            }
        }

        // Check if a result was found
        if ($result !== null) {
            // Return the result as JSON response
            echo json_encode([
                'success' => true,
                'QPA' => $result
            ]);
        } else {
            // Return an error response if no matching QPA is found
            echo json_encode([
                'success' => false,
                'message' => 'QPA not found for the given project.'
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
