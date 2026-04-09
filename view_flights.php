<?php
session_start();
require_once('../model/flightModel.php');
$flights = getAllFlights();
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<div class="container-wide">
    <h3>Flight List</h3>

    <?php if(count($flights) > 0): ?>
        <table class="flight-table">
            <tr>
                <th>Flight No</th>
                <th>Source</th>
                <th>Destination</th>
                <th>Departure Time</th>
                <th>Actions</th>
            </tr>
            <?php foreach($flights as $f): ?>
                <tr>
                    <td><?php echo $f['flight_no']; ?></td>
                    <td><?php echo $f['source']; ?></td>
                    <td><?php echo $f['destination']; ?></td>
                    <td><?php echo $f['departure_time']; ?></td>
                    <td>
                        <a href="update_flight.php?id=<?php echo $f['id']; ?>" class="action-btn update">Update</a>
                        <a href="#" class="action-btn delete" onclick="confirmDelete(<?php echo $f['id']; ?>)">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No flights found!</p>
    <?php endif; ?>

    <div class="back-btn-container">
        <a href="dashboard.php" class="back-btn">← Back to Dashboard</a>
    </div>
</div>

<!-- JS Delete Confirmation -->
<div id="confirmPopup" class="popup">
    <div class="popup-content">
        <p>Are you sure you want to delete this flight?</p>
        <button id="yesBtn">Yes</button>
        <button id="noBtn">No</button>
    </div>
</div>

<script>
let popup = document.getElementById('confirmPopup');
let yesBtn = document.getElementById('yesBtn');
let noBtn = document.getElementById('noBtn');
let deleteId = 0;

function confirmDelete(id){
    deleteId = id;
    popup.style.display = 'block';
}

yesBtn.onclick = function(){
    window.location.href = '../controller/flightController.php?delete=' + deleteId;
}
noBtn.onclick = function(){ popup.style.display = 'none'; }
window.onclick = function(event){ if(event.target == popup){ popup.style.display = 'none'; } }
</script>
