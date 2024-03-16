<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include "db_connection.php"; // Replace "db_connection.php" with the actual filename

    // Get the email and password from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate the user credentials
    $sql = "SELECT id, username FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user with the provided credentials exists
    if ($result->num_rows == 1) {
        // User authentication successful
        session_start(); // Start a new session
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"]; // Store user ID in session for future use
        $_SESSION["username"] = $row["username"]; // Store username in session for future use
        header("Location: dashboard.php"); // Redirect to the dashboard or any other page
        exit();
    } else {
        // User authentication failed
        $error_message = "Invalid email or password. Please try again.";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
