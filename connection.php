<?php
// Assuming you have a MySQL database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "gaza donation";

$conn = mysqli_connect($host, $username, $password, $database);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id = $_POST['id'];
    $email = $_POST['email'];

    // Insert data into the database
    $sql = $conn->prepare("INSERT INTO `volunteers`(`id`, `email`) VALUES (?, ?)");
    $sql->bind_param("ss", $id, $email);

    if ($sql->execute()) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql->error;
    }

    // Close the statement
    $sql->close();
}

// Close the database connection
mysqli_close($conn);
?>



// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sample values (replace these with actual values)
$id = 1;
$first_name = "John";
$last_name = "Doe";
$email = "john.doe@example.com";
$address = "123 Main St";
$address2 = "Apt 4";
$country = "USA";
$zip = "12345";

// Insert data into the database
$sql = "INSERT INTO `donationform`(`id`, `first_name`, `last_name`, `email`, `address`, `address2`, `country`, `Zip`) 
VALUES ('$id', '$first_name', '$last_name', '$email', '$address', '$address2', '$country', '$zip')";

if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
