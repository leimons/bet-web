<?php
// Database connection details
$servername = "82.197.82.30";  // Replace with your actual host (or use 82.197.XXX.XXX)
$username = "u796327909_betloungeadmin";       // Replace with your actual username
$password = "BetLoungePass0";       // Replace with your actual password
$dbname = "u796327909_newsletter";             // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email is set
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        // Validate email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
            $stmt->bind_param("s", $email);

            // Execute the statement
            if ($stmt->execute()) {
                echo "You have been subscribed successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Invalid email address!";
        }
    }
} else {
    // Handle wrong request method
    echo "Invalid request method!";
}

$conn->close();
?>
