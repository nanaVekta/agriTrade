<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['farmer_logged'])){
    echo 'noSession';
    exit();
}
else{
    if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && isset($_GET['id'])){
        $marketId = checkValues($_GET['id']);
        $farmerId = $_SESSION['farmer_logged'];

        $sql = mysqli_query($con,"DELETE FROM farmer_market WHERE f_m_id = '$marketId' AND Farm_Id = '$farmerId'");
        if($sql){
            $query = mysqli_query($con, "DELETE FROM product_pictures WHERE f_m_id = '$marketId'");
            if($query){
                echo 'deleted';
            }
        }
        else{
            echo 'notDeleted';
        }
    }else{
        echo 'noId';
    }
}
