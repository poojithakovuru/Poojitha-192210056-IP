<?php
session_start();
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "diet_control"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL injection
    $email = stripslashes($email);
    $password = stripslashes($password);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;
        header("Location: dashboard.php"); // Redirect to dashboard or another page
    } else {
        // Login failed
        echo "<script>alert('Invalid email or password.'); window.location.href='index.html';</script>";
    }
}

$conn->close();
?>
