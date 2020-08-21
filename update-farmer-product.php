<?php session_start();
require_once 'dbconfig.php';
include 'functions.php';
if(!isset($_SESSION['farmer_logged'])){
    echo 'expired';
    exit();
}

if (isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_POST['productQuantity']) && !empty($_POST['productDescription']) && !empty($_POST['postId'])) {
    $insert = 0;
    $quantity = checkValues($_POST['productQuantity']);
    $description = checkValues($_POST['productDescription']);
    $postId = checkValues($_POST['postId']);
    $id = $_SESSION['farmer_logged'];
    $total = count($_FILES['file']['name']);
    if(!isset($_FILES['file'])){
        $query = mysqli_query($con, "UPDATE farmer_market SET quantity ='$quantity', description = '$description' WHERE Farm_Id= '$id' AND f_m_id = '$postId'");
        if ($query){
            echo 'inserted';
            exit();
        }
        else{
            echo 'error';
        }
    }
    else{
        $query = mysqli_query($con, "UPDATE farmer_market SET quantity ='$quantity', description = '$description' WHERE Farm_Id= '$id' AND f_m_id = '$postId'");
        if ($query) {
            if ($total == 0){
                echo 'inserted';
                exit();
            }
            else {
                for ($i = 0; $i < $total; $i++) {
                    $fileName = $_FILES['file']['name'][$i];
                    $tmpName = $_FILES['file']['tmp_name'][$i];
                    $fileSize = $_FILES['file']['size'][$i];
                    $fileType = $_FILES['file']['type'][$i];
                    $folder = 'uploads/';
                    $fileName = addslashes($fileName);
                    if ($fileSize > 268435456000) {
                        echo 'large';
                    } else if ($_FILES['file']['error'][$i] > 0) {
                        echo 'error';
                    } else {
                        $move = move_uploaded_file($tmpName, $folder . $fileName);
                        if ($move) {

                            $sql_query = mysqli_query($con, "INSERT INTO product_pictures(file_name, f_m_id) VALUES ('$fileName','$postId')");
                            if ($sql_query) {
                                if ($i == $total) {
                                    $insert = 1;
                                } else {
                                    $insert = 0;
                                }
                            } else {
                                echo 'error';
                            }

                        } else {
                            echo 'error';
                        }

                    }

                }
            }
            if ($insert = 1) {

                echo 'inserted';
            }

        } else {
            echo 'notInserted';
        }
    }

}
else{
    echo 'noData';
}
