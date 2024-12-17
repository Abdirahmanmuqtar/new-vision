<?php
session_start(); // Start a session
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tijaabo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Register Profile</title>
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
            <h1>Profile Registration</h1>
            <input type="text" name="name" id="name" placeholder="Name" required />
            <input type="number" name="age" id="age" placeholder="Age" required />
            <input type="text" name="location" id="location" placeholder="Location" required />
            <input type="text" name="phone" id="phone" placeholder="Phone Number" required />
            <select name="teeth" id="teeth" required>
            <option value="" disabled selected>Select Teeth Position</option>
            <option value="Up">Up</option>
            <option value="Down">Down</option>
            <option value="Both">Both</option>
        </select>
        <input type="date" name="lastVisit" id="lastVisit" placeholder="Last Visit Date" required />
        <input type="text" name="previousProcedures" id="previousProcedures" placeholder="Previous Procedures" />
        <input type="number" id="costPaid" name="costPaid" placeholder="Amount Paid" required><br>

        <select name="status" id="status" required>
            <option value="" disabled selected>Select Status</option>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
</selec>
            <input type="file" name="picture" id="picture" accept="image/*" required />
            <button type="button" onclick="registerProfile()">Register</button>
        </div>
    </div>


    <script>
         const notificationCount = localStorage.getItem('notificationCount') || 0;
            document.getElementById('notification-count').innerText = notificationCount;
 
        function registerProfile() {
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
 
   
 
     if (name && age && location && phone && picture) {
         const formData = new FormData();
         formData.append("name", name);
         formData.append("age", age);
         formData.append("location", location);
         formData.append("phone", phone);
         formData.append("teeth", teeth);
         formData.append("lastVisit", lastVisit);
         formData.append("previousProcedures", previousProcedures);
         formData.append("costPaid", costPaid);
         formData.append("status", status);
         formData.append("picture", picture);
 
         const xhr = new XMLHttpRequest();
         xhr.open("POST", "register.php", true);
         xhr.onload = function () {
             alert(this.responseText);
             if (this.responseText.includes("successfully")) {
                 // Clear the input fields
                 document.getElementById('name').value = '';
                 document.getElementById('age').value = '';
                 document.getElementById('location').value = '';
                 document.getElementById('phone').value = '';
                 document.getElementById('teeth').value = '';
                 document.getElementById('lastVisit').value = '';
                 document.getElementById('previousProcedures').value = '';
                 document.getElementById('costPaid').value = '';
                 document.getElementById('status').value = '';
                 document.getElementById('picture').value = ''; // This clears the file input

                 showNotification('New profile registered successfully!');
             }
         };
 
         xhr.send(formData);
     } else {
         alert('Please fill in all fields.');
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