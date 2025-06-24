<?php
// This single file handles both displaying the login form and processing the login attempt.

// --- PART 1: PHP LOGIC (Handles Form Submission) ---
session_start();

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require_once 'db_config.php';

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $userType = isset($_POST['userType']) ? $_POST['userType'] : '';

    if (empty($email) || empty($password) || empty($userType)) {
        header('Location: login.php?error=Please fill in all fields.');
        exit();
    }

    $tableName = '';
    $dashboard = '';
    if ($userType === 'Admin') {
        $tableName = 'admins';
        $dashboard = 'admin_dashboard.php';
    } elseif ($userType === 'Doctor') {
        $tableName = 'doctors';
        $dashboard = 'doctor_dashboard.php';
    } elseif ($userType === 'Patient') {
        $tableName = 'patients';
        $dashboard = 'patient_dashboard.php';
    } else {
        header('Location: login.php?error=Invalid user type selected.');
        exit();
    }

    $sql = "SELECT * FROM $tableName WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_fullName'] = $user['fullName'];
            $_SESSION['user_type'] = $userType;
            header("Location: $dashboard"); // Redirect to the correct dashboard
            exit();
        }
    }
    
    // If login fails for any reason (user not found, wrong password), redirect back with an error.
    header('Location: login.php?error=Invalid email, password, or user type.');
    exit();
}

// --- PART 2: HTML FORM (Displayed on Page Load) ---
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form id="loginForm" action="login.php" method="POST">
            <h2>Sign In</h2>

            <!-- This PHP block displays error or success messages -->
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class="message-box error-box">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                if (isset($_GET['success'])) {
                    echo '<p class="message-box success-box">' . htmlspecialchars($_GET['success']) . '</p>';
                }
            ?>

            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="input-group">
                <label>Login as:</label>
                <div class="radio-group">
                    <label><input type="radio" name="userType" value="Admin" required> Admin</label>
                    <label><input type="radio" name="userType" value="Doctor" required> Doctor</label>
                    <label><input type="radio" name="userType" value="Patient" checked> Patient</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Sign In</button>

            <p class="signin-link">
                Don't have an account? <a href="index.html">Register Now</a>
            </p>
        </form>
    </div>
</body>
</html>
