<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $emp_id = $_POST['employee_id'];
        $pwd = $_POST['password'];
        $dept = $_POST['dept'];
        $role = $_POST['role'];
        $position = $_POST['position'];

        try {
            // Check if a user with the same name, email, and department already exists
            $checkSql = "SELECT COUNT(*) FROM users WHERE name = :name AND email = :email AND dept = :dept";
            $stmtCheck = $pdo->prepare($checkSql);
            $stmtCheck->bindParam(':name', $name);
            $stmtCheck->bindParam(':email', $email);
            $stmtCheck->bindParam(':dept', $dept);
            $stmtCheck->execute();
            $count = $stmtCheck->fetchColumn();

            if ($count > 0) {
                // User with the same details already exists
                $response = [
                    'success' => false,
                    'message' => 'User with the same name, email, and department already exists.'
                ];
            } else {
                // User does not exist, proceed with insertion
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                $insertSql = "INSERT INTO users (username, password, name, email, dept, role, position) VALUES (:username, :password, :name, :email, :dept, :role, :position)";

                $stmt = $pdo->prepare($insertSql);

                $stmt->bindParam(':username', $emp_id);
                $stmt->bindParam(':password', $hashedPwd);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':dept', $dept);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':position', $position);

                if ($stmt->execute()) {
                    $response = [
                        'success' => true,
                        'message' => 'New User added!'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Failed to add user'
                    ];
                }
            }
        } catch (PDOException $e) {
            // Handle database errors
            $response = [
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ];
        }
        echo json_encode($response);
        exit();
    } elseif ($_POST['action'] === 'edit') {
        $id = $_POST['id'];
        // $name = $_POST['name'];
        $email = $_POST['email'];
        $emp_id = $_POST['employee_id'];
        $pwd = $_POST['password'];
        $dept = $_POST['dept'];
        $role = $_POST['role'];
        $position = $_POST['position'];

        // Hash the new password if it is provided
        if (!empty($pwd)) {
            $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);
        }
        try {
            // Prepare and execute the SQL query to update the user
            $updateSql = "UPDATE users SET username = :username, email = :email, dept = :dept, role = :role, position = :position ";

            // Include the password update only if a new password is provided
            if (!empty($pwd)) {
                $updateSql .= ", password = :password";
            }

            $updateSql .= " WHERE ID = :id";

            $stmt = $pdo->prepare($updateSql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':username', $emp_id);
            // $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':dept', $dept);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':position', $position);

            // Include the password binding only if a new password is provided
            if (!empty($pwd)) {
                $stmt->bindParam(':password', $hashedPwd);
            }

            if ($stmt->execute()) {
                // Update was successful
                $response = [
                    'success' => true,
                    'message' => 'User edited successfully'
                ];
            } else {
                // Update failed
                $response = [
                    'success' => false,
                    'message' => 'Failed to edit user'
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
    } elseif ($_POST['action'] === 'delete') {
        $id = $_POST['id'];

        try {
            // Prepare and execute the SQL query to delete the user
            $deleteSql = "DELETE FROM users WHERE ID = :id";
            $stmt = $pdo->prepare($deleteSql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Deletion was successful
                $response = [
                    'success' => true,
                    'message' => 'User deleted successfully'
                ];
            } else {
                // Deletion failed
                $response = [
                    'success' => false,
                    'message' => 'Failed to delete user'
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
    } else {
        // Handle form submission without the 'submit' button
        $message = "Form not submitted.";
        header('Location: ../view/bc_add_user.php?message=' . urlencode($message)); // Pass the message as a URL parameter
        exit();
    }
} else {
    // Prepare and execute the SQL query using PDO
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // Fetch data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Return data as JSON response
    echo json_encode($data);
}
