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
$email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';

if (!$email) {
    echo "Invalid email address. Please enter a valid email.";
    exit();
}

// Perform SQL insertion for volunteerss table
$sqlVolunteers = $conn->prepare("INSERT INTO volunteerss (email) VALUES (?)");
$sqlVolunteers->bind_param("s", $email);

if ($sqlVolunteers->execute()) {
    // Perform SQL insertion for donation_data table
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];

    $sqlDonation = $conn->prepare("INSERT INTO donations (first_name, last_name, email, address, address2, country, zip) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sqlDonation->bind_param("sssssss", $firstName, $lastName, $email, $address, $address2, $country, $zip);

    if ($sqlDonation->execute()) {
        echo "Records inserted successfully";
    } else {
        echo "Error: " . $sqlDonation->error;
    }

    // Close donation_data statement
    $sqlDonation->close();
} else {
    // Log the error and provide feedback to the user.
    error_log("Error: " . $sqlVolunteers->error, 0);
    echo "Error processing your registration. Please try again later.";
}

// Close the connection
$conn->close();
?>
