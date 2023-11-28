<?php include_once 'bc_header.php';
session_start();
function displayError($message)
{
    echo '<div class="alert alert-danger" role="alert"><i class="bi bi-exclamation-triangle-fill"></i> ' . $message . '</div>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../controllers/db.php';
    $empid = $_POST['empid'];
    $password = $_POST['password'];

    // Retrieve the hashed password from the database
    $query = "SELECT * FROM users WHERE username = :empid";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':empid', $empid, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $hashedPassword = $user['password'];
        // Verify the password using password_verify
        if (password_verify($password, $hashedPassword)) {
            // Authentication successful
            $_SESSION['Emp_ID'] = $user['username'];
            $_SESSION['Name'] = $user['name'];
            $_SESSION['Email'] = $user['email'];
            $_SESSION['Department'] = $user['dept'];
            $_SESSION['Role'] = $user['role'];
            $_SESSION['Position'] = $user['position'];

            if ($_SESSION['Department'] === "Business Control" || $_SESSION['Department'] === "EVP") {
                header('location: bc_dashboard.php');
                exit();
            } else if ($_SESSION['Department'] === "Purchasing") {
                header('location: pur_dashboard.php');
                exit();
            } else if ($_SESSION['Department'] === "Sourcing") {
                header('location: sor_dashboard.php');
                exit();
            } else {
                header('location: bc_login.php');
                exit();
            }
        } else {
            // Wrong Password
            $errorMessage = "Authentication Failed";
        }
    } else {
        // User not found
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            /* background-color: #f2f2f2; */
            min-height: 100vh;
            background-image: url("../assets/images/pimesbg6.jpg");
            background-attachment: fixed;
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <main class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card border-3 border-dark">
                    <div class="card-body">
                        <h1 class="h3 mb-3 fw-bold text-start">Login</h1>
                        <?php
                        // Call the displayError function when there's an error message to display
                        if (isset($errorMessage)) {
                            displayError($errorMessage);
                        }
                        ?>
                        <form method="POST">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <input type="text" name="empid" class="form-control" id="inputEmpID" placeholder="Employee ID" autocomplete="username" required>
                                    <label for="inputEmpID" class="visually-hidden">Employee ID</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" autocomplete="new-password" required>
                                    <label for="inputPassword" class="visually-hidden">Password</label>
                                </div>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer section -->
    <div class="container-fluid py-2 fixed-bottom" style="background-color: #2706F0;">
        <div class="row">
            <div class="col fw-bold text-white">
                <span class="mb-md-0">&copy; P.IMES - ATS Business Control 2023</span>
            </div>
        </div>
    </div>
</body>

</html>