<?php
// Database configuration
$dbHost     = "localhost"; // Host name: localhost / pcse2pp1de0738
$dbUsername = "root"; // Mysql username 
$dbPassword = "adminGym666"; // Mysql password 
$dbName  = "dbgym"; // Database name

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>