<?php
session_start();
require_once('../model/adminModel.php');

if(isset($_POST['login'])){

    if($_POST['username']=="" || $_POST['password']==""){
        echo "Field cannot be empty";
        exit();
    }

    $status = adminLogin($_POST['username'], $_POST['password']);

    if($status){
        $_SESSION['admin'] = $_POST['username'];
        header('location: ../view/dashboard.php');
    }else{
        echo "Invalid login!";
    }
}

if(isset($_POST['signup'])){
    $status = adminSignup($_POST['username'], $_POST['password'], $_POST['email']);

    if($status){
        header('location: ../view/login.php');
    }else{
        echo "Signup failed!";
    }
}
?>
