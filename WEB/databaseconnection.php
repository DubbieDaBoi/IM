<?php
// Include database configuration
include_once "config.php";

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set character set to utf8mb4 (optional)
mysqli_set_charset($conn, "utf8mb4");

// Error handling function
function handle_database_error($conn, $query)
{
    die("Database error: " . mysqli_error($conn) . "<br>Query: " . $query);
}
