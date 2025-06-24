<?php
// logout.php
session_start();      // 1. Resume the session
session_unset();      // 2. Unset all session variables
session_destroy();    // 3. Destroy the session data
header("Location: login.php?success=You have been logged out."); // 4. Redirect to login
exit();
?>