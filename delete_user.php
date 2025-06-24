
<!-- ====================================================================== -->
<!-- delete_user.php -->
<!-- ====================================================================== -->
<?php
session_start();
require_once 'db_config.php';

// Security: Only Admins can access this script
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php?error=You are not authorized to perform this action.");
    exit();
}

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$userType = isset($_GET['type']) ? $_GET['type'] : '';

$tableName = '';
if ($userType === 'Doctor') {
    $tableName = 'doctors';
} elseif ($userType === 'Patient') {
    $tableName = 'patients';
} else {
    header("Location: admin_dashboard.php?error=Invalid user type for deletion.");
    exit();
}

if ($userId > 0) {
    $sql = "DELETE FROM $tableName WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $userId);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=User deleted successfully.");
    } else {
        header("Location: admin_dashboard.php?error=Error deleting user.");
    }
    $stmt->close();
    $conn->close();
    exit();
} else {
    header("Location: admin_dashboard.php?error=Invalid user ID.");
    exit();
}
?>
