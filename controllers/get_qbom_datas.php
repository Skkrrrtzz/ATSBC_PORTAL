<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Set the cache directory
    $cacheDirectory = 'cache/';

    // Check if data is in the cache file
    $cacheAllQbomFile = $cacheDirectory . 'cached_allqboms.json';

    if (isset($_GET['allqboms'])) {

        if (file_exists($cacheAllQbomFile) && time() - filemtime($cacheAllQbomFile) < 3600) {
            // Use cached data
            $allData = json_decode(file_get_contents($cacheAllQbomFile), true);
        } else {
            // Data not in cache, fetch from the database
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
                'SWAP Housing' => 'swap1_qbom',
                'SWAP Preciser' => 'swap2_qbom',
                'SWAP Robot Add On' => 'swap3_qbom',
                'SWAP Gripper Robot' => 'swap4_qbom',
                'SWAP Service Station' => 'swap5_qbom',
                'SWAP Accessories' => 'swap6_qbom',
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

            // Store data in the cache file
            file_put_contents($cacheAllQbomFile, json_encode($allData));
        }

        // Return data to AJAX request
        echo json_encode($allData);
        exit();
    }
    // if (isset($_GET['allqboms'])) {
    //     $tableMappings = [
    //         'JLP' => 'jlp_qbom',
    //         'JLP CABLE' => 'jlpcable_qbom',
    //         'MTP' => 'mtp_qbom',
    //         'FLIPPER' => 'flipper_qbom',
    //         'HIGHMAG' => 'highmag_qbom',
    //         'IONIZER' => 'ionizer_qbom',
    //         'RCMTP' => 'rcmtp_qbom',
    //         'JTP' => 'jtp_qbom',
    //         'OLB' => 'olb_qbom',
    //         'PNP' => 'pnp_qbom',
    //         'PNP CABLE' => 'pnpcable_qbom',
    //         'SWAP Housing' => 'swap1_qbom',
    //         'SWAP Preciser' => 'swap2_qbom',
    //         'SWAP Robot Add On' => 'swap3_qbom',
    //         'SWAP Gripper Robot' => 'swap4_qbom',
    //         'SWAP Service Station' => 'swap5_qbom',
    //         'SWAP Accessories' => 'swap6_qbom',
    //     ];

    //     // Initialize an empty array to store all the data
    //     $allData = [];

    //     // Loop through table mappings and retrieve data
    //     foreach ($tableMappings as $tableName => $table) {
    //         // Construct the SQL query to select all columns from the table
    //         $query = "SELECT * FROM $table";

    //         $stmt = $pdo->query($query);

    //         if ($stmt) {
    //             $tableData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //             // Add the table name to each row
    //             foreach ($tableData as &$row) {
    //                 $row['QBOM'] = $tableName;
    //             }
    //             // Merge the data into the allData array
    //             $allData = array_merge($allData, $tableData);
    //         }
    //     }
    //     echo json_encode($allData);
    //     exit();
    // } 
    else {
        // Function to fetch data from the database or cache
        function fetchData($pdo, $table, $cacheFile)
        {
            if (file_exists($cacheFile) && time() - filemtime($cacheFile) < 3600) {
                // Use cached data
                return json_decode(file_get_contents($cacheFile), true);
            }

            // Data not in cache, fetch from the database
            $sql = "SELECT * FROM $table";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Store data in the cache file
            file_put_contents($cacheFile, json_encode($data));

            return $data;
        }

        // Handle the case where a specific table is requested
        if (isset($_GET['pnp'])) {
            $table = 'pnp_qbom';
        } elseif (isset($_GET['pnp_cable'])) {
            $table = 'pnpcable_qbom';
        } elseif (isset($_GET['jlp'])) {
            $table = 'jlp_qbom';
        } elseif (isset($_GET['jlp_cable'])) {
            $table = 'jlpcable_qbom';
        } elseif (isset($_GET['jtp'])) {
            $table = 'jtp_qbom';
        } elseif (isset($_GET['mtp'])) {
            $table = 'mtp_qbom';
        } elseif (isset($_GET['olb'])) {
            $table = 'olb_qbom';
        } elseif (isset($_GET['flipper'])) {
            $table = 'flipper_qbom';
        } elseif (isset($_GET['highmag'])) {
            $table = 'highmag_qbom';
        } elseif (isset($_GET['ionizer'])) {
            $table = 'ionizer_qbom';
        } elseif (isset($_GET['rcmtp'])) {
            $table = 'rcmtp_qbom';
        } elseif (isset($_GET['swap1'])) {
            $table = 'swap1_qbom';
        } elseif (isset($_GET['swap2'])) {
            $table = 'swap2_qbom';
        } elseif (isset($_GET['swap3'])) {
            $table = 'swap3_qbom';
        } elseif (isset($_GET['swap4'])) {
            $table = 'swap4_qbom';
        } elseif (isset($_GET['swap5'])) {
            $table = 'swap5_qbom';
        } elseif (isset($_GET['swap6'])) {
            $table = 'swap6_qbom';
        } else {
            // Handle the case where no specific table is requested
            die("Invalid request");
        }

        // Set the cache file for the specific table
        $cacheQbomFile = $cacheDirectory . "cached_$table.json";

        // Fetch data from the database or cache
        $data = fetchData($pdo, $table, $cacheQbomFile);

        // Return data to AJAX request
        echo json_encode($data);
        exit();
        // if (isset($_GET['pnp'])) {
        //     $sql = "SELECT * FROM pnp_qbom";
        // } elseif (isset($_GET['pnp_cable'])) {
        //     $sql = "SELECT * FROM pnpcable_qbom";
        // } elseif (isset($_GET['jlp'])) {
        //     $sql = "SELECT * FROM jlp_qbom";
        // } elseif (isset($_GET['jlp_cable'])) {
        //     $sql = "SELECT * FROM jlpcable_qbom";
        // } elseif (isset($_GET['jtp'])) {
        //     $sql = "SELECT * FROM jtp_qbom";
        // } elseif (isset($_GET['mtp'])) {
        //     $sql = "SELECT * FROM mtp_qbom";
        // } elseif (isset($_GET['olb'])) {
        //     $sql = "SELECT * FROM olb_qbom";
        // } elseif (isset($_GET['flipper'])) {
        //     $sql = "SELECT * FROM flipper_qbom";
        // } elseif (isset($_GET['highmag'])) {
        //     $sql = "SELECT * FROM highmag_qbom";
        // } elseif (isset($_GET['ionizer'])) {
        //     $sql = "SELECT * FROM ionizer_qbom";
        // } elseif (isset($_GET['rcmtp'])) {
        //     $sql = "SELECT * FROM rcmtp_qbom";
        // } elseif (isset($_GET['swap1'])) {
        //     $sql = "SELECT * FROM swap1_qbom";
        // } elseif (isset($_GET['swap2'])) {
        //     $sql = "SELECT * FROM swap2_qbom";
        // } elseif (isset($_GET['swap3'])) {
        //     $sql = "SELECT * FROM swap3_qbom";
        // } elseif (isset($_GET['swap4'])) {
        //     $sql = "SELECT * FROM swap4_qbom";
        // } elseif (isset($_GET['swap5'])) {
        //     $sql = "SELECT * FROM swap5_qbom";
        // } elseif (isset($_GET['swap6'])) {
        //     $sql = "SELECT * FROM swap6_qbom";
        // } else {
        //     // Handle the case where no specific table is requested
        //     die("Invalid request");
        // }

        // $stmt = $pdo->prepare($sql);
        // $stmt->execute();
        // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // echo json_encode($data);
        // exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // if (isset($_POST['Delta_PN']) && isset($_POST['projects'])) {
    //     $projects = isset($_POST['projects']) ? $_POST['projects'] : '';
    //     $deltaPN = isset($_POST['Delta_PN']) ? $_POST['Delta_PN'] : '';

    //     // Define an associative array to map project names to table names
    //     $tableMappings = [
    //         'JLP' => 'jlp_qbom',
    //         'JLP CABLE' => 'jlpcable_qbom',
    //         'MTP' => 'mtp_qbom',
    //         'FLIPPER' => 'flipper_qbom',
    //         'HIGHMAG' => 'highmag_qbom',
    //         'IONIZER' => 'ionizer_qbom',
    //         'RCMTP' => 'rcmtp_qbom',
    //         'JTP' => 'jtp_qbom',
    //         'OLB' => 'olb_qbom',
    //         'PNP' => 'pnp_qbom',
    //         'PNP CABLE' => 'pnpcable_qbom',
    //         'SWAP' => ['swap1_qbom', 'swap2_qbom', 'swap3_qbom', 'swap4_qbom', 'swap5_qbom', 'swap6_qbom']
    //     ];

    //     $result = null;
    //     $table_value = "";

    //     // Iterate through all projects
    //     foreach ($tableMappings as $project => $table) {
    //         // Skip the initial project if specified
    //         if ($project === $projects) {
    //             continue;
    //         }
    //         echo $project;

    //         $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
    //         $stmt = $pdo->prepare($selectSql);
    //         $stmt->bindParam(':deltaPN', $deltaPN);
    //         $stmt->execute();
    //         $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($row && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
    //             // If the value is found and not null, set it as the result and break the loop
    //             $result = $row['Unit_Price_USD_before_Mark_Up'];
    //             $table_value = $project;
    //             echo "Found result in $table for $project\n";
    //             break;
    //         }
    //     }
    //     if ($result !== null) {
    //         // Return the result as JSON response
    //         echo json_encode([
    //             'success' => true,
    //             'message' => $result,
    //             'table' => 'QBOM Price found in ' . $table_value
    //         ]);
    //     } else {
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Unit Price USD before Mark Up not found in any project table.'
    //         ]);
    //     }
    // } else {
    //     // Handle the case where Delta_PN is not provided in the POST request
    //     echo json_encode([
    //         'success' => false,
    //         'message' => 'Delta_PN not provided in the request.'
    //     ]);
    // }
    // if (isset($_POST['Delta_PN']) && isset($_POST['projects'])) {
    //     $deltaPN = $_POST['Delta_PN'];
    //     $projects = $_POST['projects'];

    //     // Define an associative array to map project names to table names
    //     $tableMappings = [
    //         'JLP' => 'jlp_qbom',
    //         'JLP CABLE' => 'jlpcable_qbom',
    //         'MTP' => 'mtp_qbom',
    //         'FLIPPER' => 'flipper_qbom',
    //         'HIGHMAG' => 'highmag_qbom',
    //         'IONIZER' => 'ionizer_qbom',
    //         'RCMTP' => 'rcmtp_qbom',
    //         'JTP' => 'jtp_qbom',
    //         'OLB' => 'olb_qbom',
    //         'PNP' => 'pnp_qbom',
    //         'PNP CABLE' => 'pnpcable_qbom',
    //         // 'SPARES' => 'spares_qbom'
    //     ];

    //     if (isset($tableMappings[$projects])) {
    //         $table = $tableMappings[$projects];
    //         $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
    //         $stmt = $pdo->prepare($selectSql);
    //         $stmt->bindParam(':deltaPN', $deltaPN);
    //         $stmt->execute();
    //         $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if ($row !== false && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
    //             // Return the result as JSON response
    //             echo json_encode([
    //                 'success' => true,
    //                 'message' => $row['Unit_Price_USD_before_Mark_Up'],
    //                 'table' => 'QBOM Price found in ' . $projects
    //             ]);
    //         } else {
    //             $result = null; // Initialize result variable
    //             $table_value = "";
    //             // Iterate through the tables
    //             foreach ($tableMappings as $project => $table) {
    //                 if (isset($tableMappings[$projects])) {
    //                     $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
    //                     $stmt = $pdo->prepare($selectSql);
    //                     $stmt->bindParam(':deltaPN', $deltaPN);
    //                     $stmt->execute();
    //                     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //                     if ($row && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
    //                         // If the value is found and not null, set it as the result and break the loop
    //                         $result = $row['Unit_Price_USD_before_Mark_Up'];
    //                         $table_value = $project;
    //                         break;
    //                     }
    //                 }
    //             }

    //             if ($result !== null) {
    //                 // Return the result as JSON response
    //                 echo json_encode([
    //                     'success' => true,
    //                     'message' => $result,
    //                     'table' => 'QBOM Price found in ' . $table_value
    //                 ]);
    //             } else {
    //                 echo json_encode([
    //                     'success' => false,
    //                     'message' => 'Unit Price USD before Mark Up not found in the selected or alternate project.'
    //                 ]);
    //             }
    //         }
    //     } else {
    //         // Handle the case where the project name is not recognized
    //         echo json_encode([
    //             'success' => false,
    //             'message' => 'Invalid project name provided.'
    //         ]);
    //     }
    // } else {
    //     // Handle the case where Delta_PN is not provided in the POST request
    //     echo json_encode([
    //         'success' => false,
    //         'message' => 'Delta_PN not provided in the request.'
    //     ]);
    // }
    function checkTable($pdo, $table, $deltaPN, $project)
    {
        $selectSql = "SELECT Unit_Price_USD_before_Mark_Up FROM $table WHERE Item = :deltaPN";
        $stmt = $pdo->prepare($selectSql);
        $stmt->bindParam(':deltaPN', $deltaPN);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['Unit_Price_USD_before_Mark_Up'] !== null) {
            return [
                'result' => $row['Unit_Price_USD_before_Mark_Up'],
                'table_value' => $project
            ];
        }

        return [
            'result' => null,
            'table_value' => null
        ];
    }

    if (isset($_POST['Delta_PN']) && isset($_POST['projects'])) {
        $projects = isset($_POST['projects']) ? $_POST['projects'] : '';
        $deltaPN = isset($_POST['Delta_PN']) ? $_POST['Delta_PN'] : '';

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

        $swapTables = ['SWAP' => ['swap1_qbom', 'swap2_qbom', 'swap3_qbom', 'swap4_qbom', 'swap5_qbom', 'swap6_qbom']];

        $result = null;
        $table_value = null;

        // Check swap tables
        if ($projects === 'SWAP') {
            foreach ($swapTables['SWAP'] as $swapTable) {
                $resultData = checkTable($pdo, $swapTable, $deltaPN, $projects);
                $result = $resultData['result'];
                $table_value = $resultData['table_value'];
                if ($result !== null) {
                    break;
                }
            }
        } else {
            // Check the specified project table
            if (isset($tableMappings[$projects])) {
                $resultData = checkTable($pdo, $tableMappings[$projects], $deltaPN, $projects);
                $result = $resultData['result'];
                $table_value = $resultData['table_value'];

                if ($result === null) {
                    // Check all project tables
                    foreach ($tableMappings as $project => $table) {
                        if (
                            $project !== $projects
                        ) {
                            $resultData = checkTable($pdo, $table, $deltaPN, $project);
                            $result = $resultData['result'];
                            $table_value = $resultData['table_value'];
                            if (
                                $result !== null
                            ) {
                                break;
                            }
                        }
                    }
                }
            }
        }

        // Output result
        if ($result !== null) {
            echo json_encode([
                'success' => true,
                'message' => $result,
                'table' => "QBOM Price found in $table_value"
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Unit Price USD before Mark Up not found in project table.'
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
