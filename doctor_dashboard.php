<!-- ====================================================================== -->
<!-- doctor_dashboard.php -->
<!-- ====================================================================== -->
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Doctor') { header("Location: login.php"); exit(); }
$userName = $_SESSION['user_fullName'];
?>
<!DOCTYPE html><html lang="en"><head><title>Doctor Dashboard</title><link rel="stylesheet" href="style.css"></head><body>
<div class="dashboard-container"><div class="dashboard-header"><h2>Welcome, Dr. <?php echo htmlspecialchars($userName); ?>!</h2><a href="logout.php" class="submit-btn">Logout</a></div><p>This is your Doctor Dashboard. You can view your appointments and patient information here.</p></div></body></html>
