<?php session_start();
require_once 'dbconfig.php';
include 'functions.php';
if(!isset($_SESSION['farmer_logged'])){
    echo 'expired';
    exit();
}

if (isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_POST['productQuantity']) && !empty($_POST['productDescription'])) {
    $insert = 0;
    $quantity = checkValues($_POST['productQuantity']);
    $description = checkValues($_POST['productDescription']);
    $id = $_SESSION['farmer_logged'];
    $total = count($_FILES['file']['name']);


    $query = mysqli_query($con, "INSERT INTO farmer_market (quantity, description, Farm_Id)
                                                    VALUES ('$quantity','$description','$id')");
    if ($query) {
        $marketId = mysqli_insert_id($con);

        for ($i = 0; $i < $total; $i++) {
            $fileName = $_FILES['file']['name'][$i];
            $tmpName = $_FILES['file']['tmp_name'][$i];
            $fileSize = $_FILES['file']['size'][$i];
            $fileType = $_FILES['file']['type'][$i];
            $folder = 'uploads/';
            $fileName = addslashes($fileName);
            if ($fileSize > 268435456000) {
                echo 'large';
            }
            else if ($_FILES['file']['error'][$i] > 0) {
                echo 'error';
            }
            else {
                $move = move_uploaded_file($tmpName, $folder . $fileName);
                if ($move) {

                    $sql_query = mysqli_query($con, "INSERT INTO product_pictures(file_name, f_m_id) VALUES ('$fileName','$marketId')");
                    if ($sql_query) {
                        if ($i == $total) {
                            $insert = 1;
                        } else {
                            $insert = 0;
                        }
                    } else {
                        echo 'error';
                    }

                }
                else {
                    echo 'error';
                }

            }

        }
        if ($insert = 1) {
            $select_query = mysqli_query($con, "SELECT * FROM product_pictures WHERE f_m_id = '$marketId'");
            $picRow = mysqli_fetch_array($select_query);
            $numOfPics = mysqli_num_rows($select_query);
            $newNum = $numOfPics - 1;
            $fileName = $picRow['file_name'];
            $result = '<div class="form-signin" style="color: #333">';
            $result .= '<img src="uploads/' . $fileName . '" class="img-responsive img-thumbnail" align="center">';
            $result .= '<a href="#" class="small">'.$newNum.' more picture(s)</a>';
            $result .= '<br>';
            $result .= '<br>';
            $result .= '<p><strong>Product: </strong> ' . $description . '</p>';
            $result .= '<p><strong>Quantity: </strong> ' . $quantity . '</p>';
            $result .= '<p class="small"><small><strong>Posted on: </strong>'.date('Y-m-j G:i:s',time()).'</small></p>';
            $result .= '<hr>';
            $result .= '<div class="clearfix">';
            $result .= '<button class="btn btn-primary pull-left btn-sm update" id="update-' . $marketId . '"><span class="fa fa-edit"></span> edit</button>';
            $result .= '<button class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#modal-'.$marketId.'"><span class="fa fa-trash"></span> delete</button>';
            $result .= '</div>';
            $result .= '</div>';

            $result .= '<div class="modal fade" id="modal-'.$marketId.'" tabindex="-1">';
            $result .= '<div class="modal-dialog">';
            $result .= '<div class="modal-content">';
            $result .= '<div class="modal-header">';
            $result .= '<button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>';
            $result .= '<h3 class="modal-title">Delete Post</h3>';
            $result .= '</div>';
            $result .= '<div class="modal-body" id="deleteModalDiv-'.$marketId.'">';
            $result .= '<div class="alert alert-danger">';
            $result .= '<h4 class="text-center">';
            $result .= '<span class="fa fa-exclamation-triangle"></span>&nbsp; &nbsp;';
            $result .= 'Do you really want to delete this post?';
            $result .= '</h4>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '<div class="modal-footer">';
            $result .= '<div class="clearfix">';
            $result .= '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">';
            $result .= '<span class="fa fa-close"></span> Close';
            $result .= '</button>';
            $result .= '<button type="button" class="btn btn-danger delete pull-right" id="delete-'.$marketId.'">';
            $result .= '<span class="fa fa-trash"></span> Delete';
            $result .= '</button>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';
            $result .= '</div>';

            echo $result;
        }

    } else {
        echo 'notInserted';
    }
}
else{
    echo 'noData';
}
