<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "best";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize user inputs
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $age = isset($_POST['age']) ? $_POST['age'] : null;
    $location = isset($_POST['location']) ? $_POST['location'] : null;
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $teeth = isset($_POST['teeth']) ? $_POST['teeth'] : null;
    $lastVisit = isset($_POST['lastVisit']) ? $_POST['lastVisit'] : null;
    $previousProcedures = isset($_POST['previousProcedures']) ? $_POST['previousProcedures'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;
    $costPaid = isset($_POST['costPaid']) ? $_POST['costPaid'] : null; // Get the costPaid field
    $picture = isset($_FILES['picture']) ? $_FILES['picture'] : null;

    // Sanitize inputs for XSS prevention
    $name = htmlspecialchars($name);
    $location = htmlspecialchars($location);
    $phone = htmlspecialchars($phone);
    $teeth = htmlspecialchars($teeth);
    $previousProcedures = htmlspecialchars($previousProcedures);
    $status = htmlspecialchars($status);
    $costPaid = htmlspecialchars($costPaid); // Sanitize costPaid

    // Validate inputs
    if (empty($name) || empty($age) || empty($location) || empty($phone) || empty($teeth) || empty($lastVisit) || empty($status) || !is_numeric($costPaid)) {
        echo "All fields are required, and costPaid must be a valid number.";
        exit();
    }

    // Prepare the SQL query for updating the profile
    $sql = "UPDATE profiles SET name=?, age=?, location=?, phone=?, teeth=?, lastVisit=?, previousProcedures=?, costPaid=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sisssssisi", $name, $age, $location, $phone, $teeth, $lastVisit, $previousProcedures, $costPaid, $status, $id);

        if ($stmt->execute()) {
            // Handle picture upload if there's one
            if ($picture && $picture['error'] === UPLOAD_ERR_OK) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxSize = 2 * 1024 * 1024; // 2MB
                if (in_array($picture['type'], $allowedTypes) && $picture['size'] <= $maxSize) {
                    $targetDir = "images/";
                    $targetFile = $targetDir . basename($picture["name"]);
                    if (move_uploaded_file($picture["tmp_name"], $targetFile)) {
                        // Update picture path in the database
                        $sql = "UPDATE profiles SET picture=? WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        if ($stmt) {
                            $stmt->bind_param("si", $targetFile, $id);
                            $stmt->execute();
                        }
                    } else {
                        echo "Error moving uploaded file.";
                    }
                } else {
                    echo "Invalid file type or file too large.";
                }
            }
            echo "Profile updated successfully!";
        } else {
            echo "Something went wrong. Please try again later.";
        }
        $stmt->close();
    } else {
        echo "Error preparing the statement.";
    }
}

$conn->close();
?>
