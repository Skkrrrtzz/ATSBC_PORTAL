<?php
require_once 'db.php';

try {
    // Retrieve the search term from the AJAX request
    $searchTerm = $_POST["searchTerm"];

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
        'PNP CABLE' => 'pnpcable_qbom',
    ];

    $queryParts = [];

    foreach ($tableMappings as $project => $tableName) {
        $queryParts[] = "SELECT '$project' AS TableName, Item FROM $tableName WHERE Item LIKE :searchTerm";
    }

    $fullQuery = implode(' UNION ', $queryParts);

    // Prepare and execute the database query with a prepared statement
    $stmt = $pdo->prepare($fullQuery);
    $stmt->execute(['searchTerm' => "%$searchTerm%"]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        foreach ($results as $row) {
            echo "<p id='result' class='m-2 border-bottom border-dark-subtle'>" . $row["TableName"] . " - " . $row["Item"] . "</p>";
        }
    } else {
        echo "No results found in any table.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
