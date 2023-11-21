<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['allqboms'])) {
        $tableMappings = [
            'JLP' => 'jlp_qbom',
            'JLP CABLE' => 'jlpcable_qbom',
            'MTP' => 'mtp_qbom',
            'FLIPPER' => 'flipper_qbom',
            'HIGHMAG' => 'highmag_qbom',
            'IONIZER' => 'ionizer_qbom',
            'RCMTP' => 'rcmtp_qbom',
            'JTP' => 'jtp_qbom',
            'OLB' => 'olb_qbom',
            'PNP' => 'pnp_qbom',
            'PNP CABLE' => 'pnpcable_qbom'
        ];

        // Initialize an empty array to store all the data
        $allData = [];

        // Loop through table mappings and retrieve data
        foreach ($tableMappings as $tableName => $table) {
            // Construct the SQL query to select all columns from the table
            $query = "SELECT * FROM $table";

            $stmt = $pdo->query($query);

            if ($stmt) {
                $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Add the table name to each row
                foreach ($tableData as &$row) {
                    $row['QBOM'] = $tableName;
                }
                // Merge the data into the allData array
                $allData = array_merge($allData, $tableData);
            }
        }
        echo json_encode($allData);
        exit();
    } else {
        // Handle the case where a specific table is requested
        if (isset($_GET['pnp'])) {
            $sql = "SELECT * FROM pnp_qbom";
        } elseif (isset($_GET['pnp_cable'])) {
            $sql = "SELECT * FROM pnpcable_qbom";
        } elseif (isset($_GET['jlp'])) {
            $sql = "SELECT * FROM jlp_qbom";
        } elseif (isset($_GET['jlp_cable'])) {
            $sql = "SELECT * FROM jlpcable_qbom";
        } elseif (isset($_GET['jtp'])) {
            $sql = "SELECT * FROM jtp_qbom";
        } elseif (isset($_GET['mtp'])) {
            $sql = "SELECT * FROM mtp_qbom";
        } elseif (isset($_GET['olb'])) {
            $sql = "SELECT * FROM olb_qbom";
        } elseif (isset($_GET['flipper'])) {
            $sql = "SELECT * FROM flipper_qbom";
        } elseif (isset($_GET['highmag'])) {
            $sql = "SELECT * FROM highmag_qbom";
        } elseif (isset($_GET['ionizer'])) {
            $sql = "SELECT * FROM ionizer_qbom";
        } elseif (isset($_GET['rcmtp'])) {
            $sql = "SELECT * FROM rcmtp_qbom";
        } else {
            // Handle the case where no specific table is requested
            die("Invalid request");
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Delta_PN']) && isset($_POST['projects'])) {
        $deltaPN = $_POST['Delta_PN'];
        $projects = $_POST['projects'];

        // Define an associative array to map project names to table names
        $tableMappings = [
            'JLP' => 'jlp_qbom',
            'JLP CABLE' => 'jlpcable_qbom',
            'MTP' => 'mtp_qbom',
            'FLIPPER' => 'flipper_qbom',
            'HIGHMAG' => 'highmag_qbom',
            'IONIZER' => 'ionizer_qbom',
            'RCMTP' => 'rcmtp_qbom',
            'JTP' => 'jtp_qbom',
            'OLB' => 'olb_qbom',
            'PNP' => 'pnp_qbom',
            'PNP CABLE' => 'pnpcable_qbom'
            // 'SPARES' => 'spares_qbom'
        ];

        if (isset($tableMappings[$projects])) {
            $table = $tableMappings[$projects];
            $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
            $stmt = $pdo->prepare($selectSql);
            $stmt->bindParam(':deltaPN', $deltaPN);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row !== false && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
                // Return the result as JSON response
                echo json_encode([
                    'success' => true,
                    'message' => $row['Unit_Price_USD_before_Mark_Up'],
                    'table' => 'QBOM Price found in ' . $projects
                ]);
            } else {
                $result = null; // Initialize result variable
                $table_value = "";
                // Iterate through the tables
                foreach ($tableMappings as $project => $table) {
                    if (isset($tableMappings[$projects])) {
                        $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
                        $stmt = $pdo->prepare($selectSql);
                        $stmt->bindParam(':deltaPN', $deltaPN);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
                            // If the value is found and not null, set it as the result and break the loop
                            $result = $row['Unit_Price_USD_before_Mark_Up'];
                            $table_value = $project;
                            break;
                        }
                    }
                }

                if ($result !== null) {
                    // Return the result as JSON response
                    echo json_encode([
                        'success' => true,
                        'message' => $result,
                        'table' => 'QBOM Price found in ' . $table_value
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Unit Price USD before Mark Up not found in the selected or alternate project.'
                    ]);
                }
            }
        } else {
            // Handle the case where the project name is not recognized
            echo json_encode([
                'success' => false,
                'message' => 'Invalid project name provided.'
            ]);
        }
    } else {
        // Handle the case where Delta_PN is not provided in the POST request
        echo json_encode([
            'success' => false,
            'message' => 'Delta_PN not provided in the request.'
        ]);
    }
}
