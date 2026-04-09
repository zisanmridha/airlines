<?php
session_start();
require_once('../model/flightModel.php');

// Check flight number exists
function flightExists($flight_no, $excludeId=0){
    $flights = getAllFlights();
    foreach($flights as $f){
        if($f['flight_no'] == $flight_no && ($excludeId==0 || $f['id']!=$excludeId)){
            return true;
        }
    }
    return false;
}

// Validate HH:MM
function isValidTime($time){
    $parts = explode(':', $time);
    if(count($parts)!=2) return false;
    $h = (int)$parts[0]; $m = (int)$parts[1];
    return ($h>=0 && $h<=23 && $m>=0 && $m<=59);
}

// ADD Flight
if(isset($_POST['addFlight'])){
    $flight_no = trim($_POST['flight_no']);
    $source = trim($_POST['source']);
    $destination = trim($_POST['destination']);
    $time = trim($_POST['time']);

    if(!$flight_no || !$source || !$destination || !$time){
        $_SESSION['error']="All fields are required!";
        header("Location: ../view/add_flight.php"); exit();
    }
    if(flightExists($flight_no)){
        $_SESSION['error']="Flight number already exists!";
        header("Location: ../view/add_flight.php"); exit();
    }
    if(!isValidTime($time)){
        $_SESSION['error']="Invalid time! Use HH:MM 24-hour format.";
        header("Location: ../view/add_flight.php"); exit();
    }

    if(addFlight($flight_no, $source, $destination, $time)){
        header("Location: ../view/view_flights.php"); exit();
    } else {
        $_SESSION['error']="Error adding flight!";
        header("Location: ../view/add_flight.php"); exit();
    }
}

// UPDATE Flight
if(isset($_POST['updateFlight'])){
    $id = $_POST['id'];
    $flight_no = trim($_POST['flight_no']);
    $source = trim($_POST['source']);
    $destination = trim($_POST['destination']);
    $time = trim($_POST['time']);

    if(!$flight_no || !$source || !$destination || !$time){
        $_SESSION['error']="All fields are required!";
        header("Location: ../view/update_flight.php?id=$id"); exit();
    }
    if(flightExists($flight_no,$id)){
        $_SESSION['error']="Flight number already exists!";
        header("Location: ../view/update_flight.php?id=$id"); exit();
    }
    if(!isValidTime($time)){
        $_SESSION['error']="Invalid time! Use HH:MM 24-hour format.";
        header("Location: ../view/update_flight.php?id=$id"); exit();
    }

    if(updateFlight($id, $flight_no, $source, $destination, $time)){
        header("Location: ../view/view_flights.php"); exit();
    } else {
        $_SESSION['error']="Error updating flight!";
        header("Location: ../view/update_flight.php?id=$id"); exit();
    }
}

// DELETE Flight
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    if(deleteFlight($id)){
        header("Location: ../view/view_flights.php"); exit();
    } else {
        $_SESSION['error']="Error deleting flight!";
        header("Location: ../view/view_flights.php"); exit();
    }
}
?>
