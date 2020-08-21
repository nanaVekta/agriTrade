<?php
require_once 'dbconfig.php';
include_once 'functions.php';

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['buyerContact']) && !empty($_GET['buyerConfirmSignUpPassword']) && !empty($_GET['buyerSignUpPassword']) && !empty($_GET['buyerSignUpFullName']) && !empty($_GET['buyerSignUpUserName']) && !empty($_GET['buyerLocationTown']) && !empty($_GET['buyerLocationDistrict']) && !empty($_GET['buyerLocationRegion'])) {
    $fullName = checkValues($_GET['buyerSignUpFullName']);
    $username = checkValues($_GET['buyerSignUpUserName']);
    $password = checkValues($_GET['buyerSignUpPassword']);
    $conPassword = checkValues($_GET['buyerConfirmSignUpPassword']);
    $contact = checkValues($_GET['buyerContact']);
    $town = checkValues($_GET['buyerLocationTown']);
    $district = checkValues($_GET['buyerLocationDistrict']);
    $region = checkValues($_GET['buyerLocationRegion']);

    if($password != $conPassword){
        echo 'notSame';
        exit();
    }
    else{
        $password = md5($password);
    }

    $sql = mysqli_query($con, "SELECT * FROM buyer WHERE username ='$username'");
    $numOfRows = mysqli_num_rows($sql);
    if($numOfRows > 0){
        echo 'exist';
    }
    else{
        $query = mysqli_query($con, "INSERT INTO buyer (username, password, full_name, contact_number, town, district, region)
                                             VALUES ('$username','$password','$fullName','$contact','$town','$district','$region')");
        if($query){
            echo 'inserted';
        }
        else{
            echo 'notInserted';
        }
    }
}
else{
    echo 'noData';
}