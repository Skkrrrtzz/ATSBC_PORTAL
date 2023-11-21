<?php
require_once '../controllers/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Define your table mappings
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
        // Fetch the column information for the table
        $columnQuery = "SHOW COLUMNS FROM $table";
        $columnStmt = $pdo->query($columnQuery);

        if ($columnStmt) {
            $columns = $columnStmt->fetchAll(PDO::FETCH_ASSOC);

            // Construct the SQL query dynamically to select all columns from the table
            $columnNames = array_map(function ($column) {
                return $column['Field'];
            }, $columns);
            $columnsString = implode(', ', $columnNames);

            $dataQuery = "SELECT $columnsString FROM $table";
            $stmt = $pdo->query($dataQuery);

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
    }

    header('Content-Type: application/json');
    echo json_encode($allData);
} else {
    echo "not get";
}
