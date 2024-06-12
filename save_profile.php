<?php
// Database connection details
$servername = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$dbname = "diet_control";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $diet_preferences = $_POST['diet'];
    $diet_goals = $_POST['goals'];

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, age, weight, height, diet_preferences, diet_goals) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siidss", $name, $age, $weight, $height, $diet_preferences, $diet_goals);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
