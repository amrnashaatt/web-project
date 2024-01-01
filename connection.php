<?php
// Assuming you have a MySQL database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $email = $_POST['email'];

    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO `volunteers`( `email`) VALUES ( ?)");
    $sql->bind_param("ss",  $email);

    if ($sql->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql->error;
    }

    // Close the statement
    $sql->close();
}




?>
