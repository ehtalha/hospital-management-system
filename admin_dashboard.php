<?php
// admin_dashboard.php
session_start();
require_once 'db_config.php';

// Security Check: Ensure user is logged in and is an Admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Admin') {
    header("Location: login.php?error=Please log in to access the dashboard.");
    exit();
}

$adminName = $_SESSION['user_fullName'];

// Fetch all doctors and patients
$doctorsResult = $conn->query("SELECT id, fullName, email, phone, location FROM doctors ORDER BY fullName ASC");
$patientsResult = $conn->query("SELECT id, fullName, email, phone, location FROM patients ORDER BY fullName ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h2>Welcome, Admin <?php echo htmlspecialchars($adminName); ?>!</h2>
            <a href="logout.php" class="submit-btn">Logout</a>
        </div>

        <?php if(isset($_GET['message'])) { echo '<p class="message-box success-box">' . htmlspecialchars($_GET['message']) . '</p>'; } ?>
        <?php if(isset($_GET['error'])) { echo '<p class="message-box error-box">' . htmlspecialchars($_GET['error']) . '</p>'; } ?>

        <h3>Manage Doctors</h3>
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>Action</th></tr></thead>
            <tbody>
                <?php if ($doctorsResult->num_rows > 0): while($row = $doctorsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><a href="delete_user.php?id=<?php echo $row['id']; ?>&type=Doctor" class="action-btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5">No doctors found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h3>Manage Patients</h3>
        <table>
            <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Location</th><th>Action</th></tr></thead>
            <tbody>
                <?php if ($patientsResult->num_rows > 0): while($row = $patientsResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['fullName']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><a href="delete_user.php?id=<?php echo $row['id']; ?>&type=Patient" class="action-btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a></td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr><td colspan="5">No patients found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
