<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "best";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_POST['query'];
$sql = "SELECT name, age, location, phone, picture FROM profiles WHERE name LIKE ? OR phone = ?";

$stmt = $conn->prepare($sql);
$likeQuery = "%" . $query . "%";
$stmt->bind_param("si", $likeQuery, $query);
$stmt->execute();
$result = $stmt->get_result();

$profiles = array();
while ($row = $result->fetch_assoc()) {
    $profiles[] = $row;
}

$stmt->close();
$conn->close();

echo json_encode($profiles);
?>
