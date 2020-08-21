<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['farmer'])){
    echo 'noSession';
    exit();
}

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['farmLocationTown']) && !empty($_GET['farmLocationDistrict']) && !empty($_GET['farmLocationRegion'])) {
    $town = checkValues($_GET['farmLocationTown']);
    $district = checkValues($_GET['farmLocationDistrict']);
    $region = checkValues($_GET['farmLocationRegion']);
    $farmerID = $_SESSION['farmer'];

    $query = mysqli_query($con,"UPDATE farmer SET town = '$town', district = '$district', region = '$region' WHERE Farm_Id = '$farmerID'");
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