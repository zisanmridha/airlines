<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location: login.php');
}
?>
<html>
<head>
     <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Admin Dashboard</h2>
    <a href="add_flight.php">Add Flight</a><br>
    <a href="view_flights.php">View Flights</a><br>
    <a href="../controller/logout.php">Logout</a>
    </div>
</body>
</html>

