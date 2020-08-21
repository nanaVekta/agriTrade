<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';
if(!isset($_SESSION['buyer_logged'])){
    echo 'expired';
    exit();
}

if(isset( $_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_GET['durationDay']) && !empty($_GET['durationMonth']) && !empty($_GET['durationYear']) && !empty($_GET['productQuantity']) && !empty($_GET['productDescription'])) {
    $day = checkValues($_GET['durationDay']);
    $month = checkValues($_GET['durationMonth']);
    $year = checkValues($_GET['durationYear']);
    $quantity = checkValues($_GET['productQuantity']);
    $description = checkValues($_GET['productDescription']);
    $buyer = $_SESSION['buyer_logged'];

    $sql = mysqli_query($con, "SELECT * FROM buyer_market WHERE Buyer_Id = '$buyer' 
                                                            AND deadline_day = '$day' 
                                                            AND deadline_month = '$month' 
                                                            AND deadline_year = '$year' 
                                                            AND quantity = '$quantity'
                                                            AND description = '$description'");
    $numOfRows = mysqli_num_rows($sql);
    if($numOfRows > 0){
        echo 'exist';
    }
    else{
        $query = mysqli_query($con, "INSERT INTO buyer_market (deadline_day, deadline_month, deadline_year, quantity, description, Buyer_Id)
                                                       VALUES ('$day','$month','$year','$quantity','$description','$buyer')");
        if($query){
            $postId = mysqli_insert_id($con)
            ?>
            <div class="form-signin" style="color: #333">
                <p><strong>Product: </strong><?php echo $description ?></p>
                <p><strong>Quantity: </strong><?php echo $quantity ?></p>
                <p><strong>Deadline: </strong><?php echo $day.' '.$month.', '.$year ?></p>
                <p class="small"><strong>Posted on: </strong><?php echo date('Y-m-j G:i:s',time()) ?></p>
                <hr>
                <div class="clearfix">
                    <button class="btn btn-primary pull-left update" id="update-<?php echo $postId ?>"><span class="fa fa-edit"></span> edit</button>
                    <button class="btn btn-danger pull-right" id="delete" data-toggle="modal" data-target="#modal-<?php echo $postId ?>"><span class="fa fa-trash"></span> delete</button>
                </div>
            </div>

            <div class="modal fade" id="modal-<?php echo $postId ?>" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                            <h3 class="modal-title">Delete Post</h3>
                        </div>

                        <div class="modal-body" id="deleteModalDiv-<?php echo $postId ?>">
                            <div class="alert alert-danger">
                                <h4 class="text-center">
                                    <span class="fa fa-exclamation-triangle"></span>&nbsp; &nbsp;
                                    Do you really want to delete this post?
                                </h4>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="clearfix">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                    <span class="fa fa-close"></span> Close
                                </button>
                                <button type="button" class="btn btn-danger delete pull-right" id="delete-<?php echo $postId ?>">
                                    <span class="fa fa-trash"></span> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        else{
            echo 'notInserted';
        }
    }
}
else{
    echo 'noData';
}