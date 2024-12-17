<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "best";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connections
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$name = $_POST['name'];
$age = $_POST['age'];
$location = $_POST['location'];
$phone = $_POST['phone'];
$teeth = $_POST['teeth'];
$lastVisit = $_POST['lastVisit'];
$previousProcedures = $_POST['previousProcedures'];
$costPaid = isset($_POST['costPaid']) ? $_POST['costPaid'] : 0; // New field for cost paid
$status = $_POST['status'];
$picture = $_FILES['picture'];
$targetDir = "images/";
$targetFile = $targetDir . basename($picture["name"]); // Use 'name' instead of 'picture'

// Check if the picture was uploaded without errors
if ($picture['error'] === UPLOAD_ERR_OK) {
    // Move the uploaded file to the target directory
    if (move_uploaded_file($picture["tmp_name"], $targetFile)) {
        
        // Prepare and bind the SQL statement
        // Include 'costPaid' in the INSERT INTO statement
        $stmt = $conn->prepare("INSERT INTO profiles (name, age, location, phone, picture, teeth, LastVisit, previousprocedures, status, costPaid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind the parameters including costPaid
        $stmt->bind_param("sisssssssi", $name, $age, $location, $phone, $targetFile, $teeth, $lastVisit, $previousProcedures, $status, $costPaid);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    echo "Error uploading file: " . $picture['error'];
}

// Close the connection
$conn->close();
?>
