<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['buyer_logged'])){
    echo 'noSession';
    exit();
}
else{
    if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['id'])){
        $marketId = checkValues($_GET['id']);
        $buyerId = $_SESSION['buyer_logged'];

        $sql = mysqli_query($con,"DELETE FROM bids WHERE b_m_id = '$marketId' AND Buyer_Id = '$buyerId'");
        if($sql) {
            $query = mysqli_query($con, "DELETE FROM buyer_market WHERE b_m_id = '$marketId' AND Buyer_Id = '$buyerId'");
            if($query){
                echo 'deleted';

            }
            else{
                echo 'notDeleted';
            }
        }
        else{
            echo 'notDeleted';
        }
    }else{
        echo 'noId';
    }
}
