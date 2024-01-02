<?php
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Common function to validate and sanitize email
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Check if form data is submitted for Volunteerss
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['volunteer_email'])) {
    $volunteerEmail = validateEmail($_POST['volunteer_email']);

    if ($volunteerEmail) {
        $sqlVolunteers = $conn->prepare("INSERT INTO volunteerss (email) VALUES (?)");
        $sqlVolunteers->bind_param("s", $volunteerEmail);

        if ($sqlVolunteers->execute()) {
            echo "Volunteers record inserted successfully";
        } else {
            echo "Error: " . $sqlVolunteers->error;
        }

        // Close the statement
        $sqlVolunteers->close();
    } else {
        echo "Invalid email address for Volunteerss.";
    }
}

// Check if form data is submitted for Donations
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['donor_email'])) {
    $donorEmail = validateEmail($_POST['donor_email']);

    if ($donorEmail) {
        // Include other donation fields and perform SQL insertion for donations table
        // ...

        echo "Donations record inserted successfully";
    } else {
        echo "Invalid email address for Donations.";
    }
}

// Close the connection
$conn->close();
?>
