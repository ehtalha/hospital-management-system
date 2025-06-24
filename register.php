<?php
// This script handles the user registration process.

require_once 'db_config.php'; // Includes the database connection

// Check if the form was submitted using the POST method.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // --- 1. Retrieve and Sanitize Form Data ---
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $location = trim($_POST['location']);
    $password = trim($_POST['password']);
    $userType = isset($_POST['userType']) ? $_POST['userType'] : '';

    // Note: Extra server-side validation can be added here, but the JS handles most of it.
    
    // --- 2. Determine the Table Name based on User Type ---
    $tableName = '';
    if ($userType === 'Admin') {
        $tableName = 'admins';
    } elseif ($userType === 'Doctor') {
        $tableName = 'doctors';
    } elseif ($userType === 'Patient') {
        $tableName = 'patients';
    } else {
        // Redirect back with an error if user type is invalid
        header('Location: index.html?error=Invalid user type selected.');
        exit();
    }
    
    // --- 3. Hash the Password for Security ---
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // --- 4. Prepare and Execute the SQL Statement to Prevent SQL Injection ---
    $sql = "INSERT INTO $tableName (fullName, email, phone, location, password) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param('sssss', $fullName, $email, $phone, $location, $hashedPassword);
    
    // Execute and check for errors (like a duplicate email)
    if ($stmt->execute()) {
        // Success! Redirect to the login page with a success message.
        header("Location: login.php?success=Registration successful! Please sign in.");
        exit();
    } else {
        // Check for duplicate entry error
        if ($conn->errno === 1062) { // 1062 is the MySQL error number for duplicate entry
            header("Location: index.html?error=This email address is already registered.");
        } else {
            header("Location: index.html?error=An error occurred during registration.");
        }
        exit();
    }
    
    $stmt->close();
    $conn->close();

} else {
    // If the page is accessed directly, redirect to the registration form.
    header('Location: index.html');
    exit();
}
?>
