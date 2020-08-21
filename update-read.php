<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['buyer_logged'])){
    redirect_to('index.php');
    exit();
}
if (isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['bid'])){
    $buyerId = checkValues($_GET['bid']);
    if($buyerId == $_SESSION['buyer_logged']){
        $sql = mysqli_query($con, "UPDATE bids SET bid_read = '1' WHERE Buyer_Id = '$buyerId'");
        if(!$sql){
            echo 'error';
        }
    }else{
        echo 'error';
    }
}