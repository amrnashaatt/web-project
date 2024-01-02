<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $zip = $_POST['zip'];

    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO `donation_data`(`first_name`, `last_name`, `email`, `address`, `address2`, `country`, `zip`) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param("sssssss", $firstName, $lastName, $email, $address, $address2, $country, $zip);

    if ($sql->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql->error;
    }

    // Close the statement
    $sql->close();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "INSERT INTO volunteerss (email) VALUES ('$email')";

    if (mysqli_query($conn, $sql)) {
        echo "Thank you for registering! We appreciate your support. We will reach out to you as soon as possible.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
