<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['buyerUserName']) && !empty($_GET['buyerUserPassword'])) {
    $username = checkValues($_GET['buyerUserName']);
    $password = checkValues($_GET['buyerUserPassword']);
    $password = md5($password);

    $sql = mysqli_query($con, "SELECT Buyer_Id FROM buyer WHERE username ='$username' AND password = '$password'");
    if($sql) {
        $numOfRows = mysqli_num_rows($sql);
        $buyerRow = mysqli_fetch_array($sql);
        if ($numOfRows == 1) {
            $_SESSION['buyer_logged'] = $buyerRow['Buyer_Id'];
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