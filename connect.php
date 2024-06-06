<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $email = $_POST['email'];
    $current_datetime = date('Y-m-d H:i:s');

    // Connect to the MariaDB server
    $conn = new mysqli('127.0.0.1', 'root', '', 'your_database_name'); // Empty password here

    if ($conn->connect_error) {
        die('Connection Failed : ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO betz_site (datetime, email) VALUES (?, ?)");
        // Assuming `datetime` is the first column and `email` is the second column
        $stmt->bind_param("ss", $current_datetime, $email); // Change $user_email to $email
        $stmt->execute();
        echo "Inserted successfully.";
        $stmt->close();
    }

    $conn->close();
?>
