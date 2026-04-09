<?php
require_once('db.php');

function adminLogin($username, $password){
    $con = getConnection();
    $sql = "select * from admins where username='{$username}' and password='{$password}'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if($count == 1){
        return true;
    }else{
        return false;
    }
}

function adminSignup($username, $password, $email){
    $con = getConnection();
    $sql = "insert into admins values('', '{$username}', '{$password}', '{$email}')";
    $result = mysqli_query($con, $sql);

    if($result){
        return true;
    }else{
        return false;
    }
}
?>
