<?php
// Assuming you have a MySQL database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];

// Insert data into the database
$sql = "INSERT INTO `donationform`(`id`, `first_name`, `last_name`, `email`, `address`, `address2`, `country`) 
VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
