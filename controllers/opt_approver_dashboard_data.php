<?php
include_once 'db.php';
$sql = "SELECT *,
    CASE
        WHEN For_Checking_of_CCP_analyst = 'true' AND (Remarks_from_CCP_analyst IS NULL OR Remarks_from_CCP_analyst = '') THEN 'pending'
        WHEN For_Checking_of_CCP_analyst = 'true' AND Remarks_from_CCP_analyst IS NOT NULL THEN 'done'
    END AS status
FROM `ppv`";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pendingCount = 0;
$doneCount = 0;

foreach ($items as $item) {
    if ($item['status'] === 'pending') {
        $pendingCount++;
    } elseif ($item['status'] === 'done') {
        $doneCount++;
    }
}
