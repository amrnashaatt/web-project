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
$email = $_POST['email'];

// Perform SQL insertion
$sql = "INSERT INTO volunteerss (email) VALUES ('$email')";

if ($conn->query($sql) === TRUE) {
    // If the insertion is successful, you can redirect to a thank you page or display a success message.
    echo "Thank you for registering! We appreciate your support. We will reach you as soon as possible.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}





// Close the connection
$conn->close();
?>