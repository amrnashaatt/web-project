<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

$email = isset($_POST['email']) ? filter_var(mysqli_real_escape_string($conn, $_POST['email']), FILTER_VALIDATE_EMAIL) : '';

if (!$email) {
    echo "Invalid email address. Please enter a valid email.";
    exit();
}

// Perform SQL insertion
$sql = "INSERT INTO volunteerss (email) VALUES ('$email')";

if ($conn->query($sql) === TRUE) {
    // If the insertion is successful, redirect to a thank you page or display a success message.
    header("Location: thank_you_page.php");
    exit();
} else {
    // Log the error and provide feedback to the user.
    error_log("Error: " . $sql . "\n" . $conn->error, 0);
    echo "Error processing your registration. Please try again later.";
}

// Close the connection
$conn->close();
?>
