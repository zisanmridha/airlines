<?php
session_start();
require_once('../model/flightModel.php');

// Collect existing flight numbers
$flights = getAllFlights();
$flightNumbers = array_map(function($f){ return $f['flight_no']; }, $flights);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h3>Add New Flight</h3>

    <!-- Display backend error message -->
    <?php
    if(isset($_SESSION['error'])){
        echo '<div class="error-msg">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    }
    ?>

    <form id="addFlightForm" method="POST" action="../controller/flightController.php">

        <label for="flight_no">Flight Number</label>
        <input type="text" id="flight_no" name="flight_no" placeholder="Enter Flight Number" required>

        <label for="source">Source</label>
        <input type="text" id="source" name="source" placeholder="Enter Departure City" required>

        <label for="destination">Destination</label>
        <input type="text" id="destination" name="destination" placeholder="Enter Arrival City" required>

        <label for="time">Departure Time</label>
        <input type="text" id="time" name="time" placeholder="HH:MM" required>

        <button type="submit" name="addFlight">Add Flight</button>
    </form>

    <div class="back-btn-container">
        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>
</div>

<!-- JS Frontend Validation Popup -->
<div id="validationPopup" class="popup">
    <div class="popup-content">
        <p id="popupMsg"></p>
        <button id="closePopup">OK</button>
    </div>
</div>

<script>
let existingFlights = <?php echo json_encode($flightNumbers); ?>;
let popup = document.getElementById('validationPopup');
let popupMsg = document.getElementById('popupMsg');
let closePopup = document.getElementById('closePopup');

document.getElementById('addFlightForm').onsubmit = function(e) {
    let flight_no = document.getElementById('flight_no').value.trim();
    let source = document.getElementById('source').value.trim();
    let destination = document.getElementById('destination').value.trim();
    let time = document.getElementById('time').value.trim();

    // Validation checks
    if(!flight_no || !source || !destination || !time){
        e.preventDefault(); showPopup("All fields are required!"); return false;
    }
    if(existingFlights.includes(flight_no)){
        e.preventDefault(); showPopup("Flight number already exists!"); return false;
    }
    if(/\d/.test(source) || /\d/.test(destination)){
        e.preventDefault(); showPopup("Source and Destination cannot contain numbers!"); return false;
    }
    let parts = time.split(':');
    if(parts.length !== 2 || isNaN(parts[0]) || isNaN(parts[1])){
        e.preventDefault(); showPopup("Invalid time format! Use HH:MM"); return false;
    }
    let hour = parseInt(parts[0]), min = parseInt(parts[1]);
    if(hour<0 || hour>23 || min<0 || min>59){
        e.preventDefault(); showPopup("Invalid time! Use 24-hour HH:MM"); return false;
    }
}

function showPopup(msg){
    popupMsg.innerText = msg;
    popup.style.display = "block";
}
closePopup.onclick = function(){ popup.style.display = "none"; }
window.onclick = function(event){ if(event.target == popup){ popup.style.display = "none"; } }
</script>

</body>
</html>
