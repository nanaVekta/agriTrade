<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(!isset($_SESSION['farmer_logged'])){
    echo 'Session expired. Please refresh page';
    exit();
}
else{
    if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['bid'])){
        $farmerId = $_SESSION['farmer_logged'];
        $buyerMarkId = checkValues($_GET['bid']);
        $sql = mysqli_query($con, "SELECT Buyer_Id FROM buyer_market WHERE b_m_id = '$buyerMarkId'");
        $marketRow = mysqli_fetch_array($sql);
        $buyerId = $marketRow['Buyer_Id'];

        $insert_query = mysqli_query($con, "INSERT INTO bids (Farm_Id, b_m_id, Buyer_Id) VALUES ('$farmerId','$buyerMarkId','$buyerId')");
        if($insert_query){
            echo 'bid';
        }
        else{
            echo 'notBid';
        }

    }
    else{
        echo 'Parse error, please use the right approach';
    }
}
