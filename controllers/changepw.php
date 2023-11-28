<?php
require_once 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empID = $_POST['empID'];
    $newPass = $_POST['newPassword'];
    $confirmPass = $_POST['confirmPassword'];

    // Initialize $hashedPwd to null
    $hashedPwd = null;

    // Hash the new password if it is provided
    if (!empty($confirmPass)) {
        $hashedPwd = password_hash($confirmPass, PASSWORD_BCRYPT);
    }

    try {
        // Prepare and execute the SQL query to update the user's password
        $updateSql = "UPDATE users SET";

        // Include the password update only if a new password is provided
        if (!empty($hashedPwd)) {
            $updateSql .= " password = :password";
        }

        $updateSql .= " WHERE username = :empId";

        $stmt = $pdo->prepare($updateSql);
        $stmt->bindParam(':empId', $empID, PDO::PARAM_INT);

        // Include the password binding only if a new password is provided
        if (!empty($hashedPwd)) {
            $stmt->bindParam(':password', $hashedPwd);
        }

        if ($stmt->execute()) {
            // Password update was successful
            $response = [
                'success' => true,
                'message' => 'Password successfully changed!'
            ];
        } else {
            // Password update failed
            $response = [
                'success' => false,
                'message' => 'Failed to change password'
            ];
        }
    } catch (PDOException $e) {
        // Handle database errors
        $response = [
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ];
    }

    echo json_encode($response);
    exit();
}
