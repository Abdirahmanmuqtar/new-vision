<?php
session_start();
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

$id = $_GET['id']; // Get the ID from the query parameter

$sql = "SELECT * FROM profiles WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['name']);
    $age = htmlspecialchars($row['age']);
    $location = htmlspecialchars($row['location']);
    $phone = htmlspecialchars($row['Phone']);
    $picture = htmlspecialchars($row['picture']);
} else {
    echo "Profile not found.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tijaabo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Edit Profile</title>
</head>
<body>
    <div class="header">
        <div class="logo">New Vision</div>
        <div class="menu">
            <a href="index2.php" class="menu-item">Register</a>
            <a href="table.php" class="menu-item">View Patient</a>
            <a href="index3.html" class="menu-item">Search</a>
            <div class="menu-item notification-bell" onclick="clearNotification()">
            <i class="fas fa-bell"></i>
            <span class="notification-badge" id="notification-count">0</span>
        </div>
            <a href="#" class="menu-item logout" onclick="logout()">Logout</a>
        </div>
    </div>
    <div class="container">
    
        <div class="form-container">
        <h1>Edit Profile</h1>
        <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($row['age']); ?>" required><br>
        <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required><br>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($row['Phone']); ?>" required />
        <select name="teeth" id="teeth" required>
            <option value="" disabled>Select Teeth Position</option>
            <option value="Up" <?php echo ($row['teeth'] == 'Up') ? 'selected' : ''; ?>>Up</option>
            <option value="Down" <?php echo ($row['teeth'] == 'Down') ? 'selected' : ''; ?>>Down</option>
            <option value="Both" <?php echo ($row['teeth'] == 'Both') ? 'selected' : ''; ?>>Both</option>
        </select>

        <!-- Prefill Last Visit Date -->
        <input type="date" id="lastVisit" name="lastVisit" value="<?php echo htmlspecialchars($row['LastVisit']); ?>" required>

        <!-- Previous procedures -->
        <input type="text" id="previousProcedures" name="previousProcedures" value="<?php echo htmlspecialchars($row['PreviousProcedures']); ?>">
        <input type="number" id="costPaid" name="costPaid" value="<?php echo htmlspecialchars($row['costPaid']); ?>" placeholder="Amount Paid" required><br>


        <!-- Status selection -->
        <select name="status" id="status" required>
            <option value="" disabled>Select Status</option>
            <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="Completed" <?php echo ($row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
        </select>
        <input type="file" id="picture" name="picture" accept="image/*" />
        <button type="button" onclick="editProfile()">Save Changes</button>
        </div>
    </div>

    <script>
          const notificationCount = localStorage.getItem('notificationCount') || 0;
    document.getElementById('notification-count').innerText = notificationCount;

    function editProfile() {
        const id = document.getElementById('id').value;
        const name = document.getElementById('name').value;
        const age = document.getElementById('age').value;
        const location = document.getElementById('location').value;
        const phone = document.getElementById('phone').value;
        const teeth = document.getElementById('teeth').value;
        const lastVisit = document.getElementById('lastVisit').value;
        const previousProcedures = document.getElementById('previousProcedures').value;
        const costPaid = document.getElementById('costPaid').value;
        const status = document.getElementById('status').value;
        const picture = document.getElementById('picture').files[0];

        if (name && age && location && phone && teeth && lastVisit && previousProcedures && costPaid  && status) {
            const formData = new FormData();
            formData.append("id", id);
            formData.append("name", name);
            formData.append("age", age);
            formData.append("location", location);
            formData.append("phone", phone);
            formData.append("teeth", teeth);
            formData.append("lastVisit", lastVisit);
            formData.append("previousProcedures", previousProcedures);
            formData.append("costPaid", costPaid);
            formData.append("status", status);
            if (picture) {
                formData.append("picture", picture);
            }

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "edit_profile_process.php", true);
            xhr.onload = function () {
                alert(this.responseText);
                if (this.responseText.includes("successfully")) {
                    showNotification('Profile updated successfully!');
                    window.location.href = 'table.php'; // Redirect after successful edit
                }
            };

            xhr.send(formData);
        } else {
            alert('Please fill in all required fields.');
        }
    }

 function showNotification(message) {
            // Update notification count in localStorage
            let currentCount = parseInt(localStorage.getItem('notificationCount')) || 0;
            currentCount++;
            localStorage.setItem('notificationCount', currentCount);
            document.getElementById('notification-count').innerText = currentCount;

            alert(message); // Replace with Pell notification if needed
        }

        function clearNotification() {
            // Clear notifications
            localStorage.setItem('notificationCount', 0);
            document.getElementById('notification-count').innerText = '0';
            // Optionally, display a message using Pell here
        }

 function logout() {
            // Implement logout logic here (e.g., clear session)
            fetch('logout.php')
                .then(() => window.location.href = 'index.html'); // Redirect to login page
        }
 </script>
    
</body>
</html>