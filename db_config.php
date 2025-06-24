<?php
// This file contains the database connection settings.

// Turn on error reporting for debugging. REMOVE THIS IN A LIVE PROJECT.
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$dbHost = 'localhost';   // Usually 'localhost' for XAMPP
$dbUser = 'root';        // Default XAMPP username
$dbPass = '';            // Default XAMPP password is empty
$dbName = 'hospital_db'; // The name of the database you will create

// Create a database connection
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check if the connection failed
if ($conn->connect_error) {
    // If it fails, stop the script and show the error.
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
