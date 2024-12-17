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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM profiles WHERE id=$delete_id");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="tijaabo.css">
   
    <title>Register Profile</title>
    <style>
        
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #153677;
        }

        .menu {
            display: flex;
        }

        .menu-item {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .menu-item:hover {
            background-color: #4e085f;
            color: #ffffff;
        }

        .container1 {
            margin: 100px auto 20px; /* Adjust for fixed header */
            padding: 20px;
            max-width: 90%;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px 15px;
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background: linear-gradient(135deg, #153677, #4e085f);
            color: #ffffff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .menu {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            .menu-item {
                margin: 5px 0;
            }
        }
    </style>
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
    <div class="container1">
        
        <div class="table-title">
            <h2>Patient <b>Management</b></h2>
        </div>
        <div class="search-box">
            <input type="text" class="form-control" id="searchInput" placeholder="Search for Patients...">
        </div>
        <table class="table table-bordered">
            
        <thead>
    <tr>
                    <tr>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>teeth</th>
                        <th>Last Visit</th>
                        <th>Previous Procedures</th>
                        <th>status</th>
                        <th>costPaid</th>
                        <th>Picture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="ownerTableBody">
                    <!-- Example Data Rows -->
                <?php
                
                $sql = "SELECT id, name, age, location, phone, teeth, LastVisit, PreviousProcedures, costPaid, status, picture FROM profiles";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data for each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['age']) . " years old</td>";
                        echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['teeth']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['LastVisit']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PreviousProcedures']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['costPaid']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                        echo "<td><img src='" . htmlspecialchars($row['picture']) . "' alt='Profile' style='width:50px;height:50px;'></td>";
                        echo "<td>
                                <a class='action-link' href='edit_profile.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a> | 
                                <a class='action-link' href='?delete_id=" . htmlspecialchars($row['id']) . "' onclick=\"return confirm('Are you sure you want to delete this profile?');\">Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
                    <!-- Repeat similar rows as necessary -->
                </tbody>
            </table>
        </div>
    </div>
    </div>


    <script>
      

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

       
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.getElementById('ownerTableBody').getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length - 1; j++) { // Exclude actions column
                    if (cells[j].innerText.toUpperCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        });    
 </script>
    
</body>
</html>