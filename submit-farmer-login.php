<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['farmerUserName']) && !empty($_GET['farmerUserPassword'])) {
    $username = checkValues($_GET['farmerUserName']);
    $password = checkValues($_GET['farmerUserPassword']);
    $password = md5($password);

    $sql = mysqli_query($con, "SELECT Farm_Id FROM farmer WHERE username ='$username' AND password = '$password'");
    if($sql) {
        $numOfRows = mysqli_num_rows($sql);
        $farmerRow = mysqli_fetch_array($sql);
        if ($numOfRows == 1) {
            $_SESSION['farmer_logged'] = $farmerRow['Farm_Id'];
            echo 'logged';
        } else {
            echo 'error';
        }
    }else{
        echo 'queryError';
    }
}
else{
    echo 'noData';
}