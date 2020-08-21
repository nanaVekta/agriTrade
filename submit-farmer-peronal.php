<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['farmerContact']) && !empty($_GET['farmerConfirmSignUpPassword']) && !empty($_GET['farmerSignUpPassword']) && !empty($_GET['farmerSignUpFullName']) && !empty($_GET['farmerSignUpUserName']) && !empty($_GET['farmerSignUpGender'])) {
    $fullName = checkValues($_GET['farmerSignUpFullName']);
    $username = checkValues($_GET['farmerSignUpUserName']);
    $gender = checkValues($_GET['farmerSignUpGender']);
    $password = checkValues($_GET['farmerSignUpPassword']);
    $conPassword = checkValues($_GET['farmerConfirmSignUpPassword']);
    $contact = checkValues($_GET['farmerContact']);

    if($password != $conPassword){
        echo 'notSame';
        exit();
    }
    else{
        $password = md5($password);
    }

    $sql = mysqli_query($con, "SELECT * FROM farmer WHERE username ='$username'");
    $numOfRows = mysqli_num_rows($sql);
    if($numOfRows > 0){
        echo 'exist';
    }
    else{
        $query = mysqli_query($con, "INSERT INTO farmer (username, password, full_name, gender, contact_number)
                                             VALUES ('$username','$password','$fullName','$gender','$contact')");
        if($query){
            $_SESSION['farmer'] = mysqli_insert_id($con);
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