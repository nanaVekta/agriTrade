<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['buyer_logged'])){
    echo 'expired';
    exit();
}

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_POST['postId']) && !empty($_POST['durationDay']) && !empty($_POST['durationMonth']) && !empty($_POST['durationYear']) && !empty($_POST['productQuantity']) && !empty($_POST['productDescription'])) {
    $day = checkValues($_POST['durationDay']);
    $month = checkValues($_POST['durationMonth']);
    $year = checkValues($_POST['durationYear']);
    $quantity = checkValues($_POST['productQuantity']);
    $description = checkValues($_POST['productDescription']);
    $postId = checkValues($_POST['postId']);
    $buyer = $_SESSION['buyer_logged'];


        $query = mysqli_query($con, "UPDATE buyer_market SET deadline_day = '$day', deadline_month = '$month', deadline_year = '$year', quantity = '$quantity', description = '$description' 
                                     WHERE Buyer_Id = '$buyer' AND b_m_id = '$postId'");
        if($query){
            echo 'inserted';
        }
        else{
            echo 'notInserted';
        }

}
else{
    echo 'noData';
}