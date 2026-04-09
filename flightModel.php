<?php
require_once('db.php');

function addFlight($flight_no, $source, $destination, $departure_time){
    $con = getConnection();
    $sql = "INSERT INTO flights (flight_no, source, destination, departure_time) VALUES ('$flight_no','$source','$destination','$departure_time')";
    return mysqli_query($con, $sql);
}

function getAllFlights(){
    $con = getConnection();
    $sql = "SELECT * FROM flights";
    $result = mysqli_query($con, $sql);
    $flights = [];
    while($row = mysqli_fetch_assoc($result)){
        $flights[] = $row;
    }
    return $flights;
}

function getFlight($id){
    $con = getConnection();
    $sql = "SELECT * FROM flights WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    return mysqli_fetch_assoc($result);
}

function updateFlight($id, $flight_no, $source, $destination, $departure_time){
    $con = getConnection();
    $sql = "UPDATE flights SET flight_no='$flight_no', source='$source', destination='$destination', departure_time='$departure_time' WHERE id='$id'";
    return mysqli_query($con, $sql);
}

function deleteFlight($id){
    $con = getConnection();
    $sql = "DELETE FROM flights WHERE id='$id'";
    return mysqli_query($con, $sql);
}
?>
