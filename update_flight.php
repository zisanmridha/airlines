<?php
require_once('../model/flightModel.php');

// Get flight ID from URL
if(!isset($_GET['id'])){
    header('Location: dashboard.php');
    exit();
}

$id = $_GET['id'];
$flight = getFlight($id); // call model function
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<div class="container">
    <h3>Update Flight</h3>

    <form action="../controller/flightController.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $flight['id']; ?>">

        <label for="flight_no">Flight Number</label>
        <input type="text" id="flight_no" name="flight_no" value="<?php echo $flight['flight_no']; ?>" required>

        <label for="source">Source</label>
        <input type="text" id="source" name="source" value="<?php echo $flight['source']; ?>" required>

        <label for="destination">Destination</label>
        <input type="text" id="destination" name="destination" value="<?php echo $flight['destination']; ?>" required>

        <label for="time">Departure Time</label>
        <input type="text" id="time" name="time" value="<?php echo $flight['departure_time']; ?>" required>

        <button name="updateFlight">Update Flight</button>
    </form>

    <a href="view_flights.php" class="back-btn">← Back to Flights</a>
</div>
