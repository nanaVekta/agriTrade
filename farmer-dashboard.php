<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(!isset($_SESSION['farmer_logged'])){
    redirect_to('index.php');
}

$farmerID = $_SESSION['farmer_logged'];
$sql = mysqli_query($con,"SELECT * FROM farmer WHERE Farm_Id = '$farmerID'");
$farmerRow = mysqli_fetch_array($sql);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>AgriTrade | Buy and sell all agricultural products online</title>
    <meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy and sell all agricultural products online">
    <link rel="icon" href="images/agritrade-icon.png">
    <link rel="stylesheet" href="css/swipebox.css">
    <link rel="stylesheet" media="all" type="text/css" href="css/style.css">
    <link href="css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
    <link href="css/fileinput.css" rel="stylesheet" media="all" type="text/css">
    <link href="fontawesome/css/font-awesome.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="js/farmer.js"></script>
    <script type="text/javascript" src="js/jquery.swipebox.min.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
</head>
<body style="margin-top: 60px; background-color: #f5f5f5;">

<!-- navigation bar -->
<nav class="navbar  navbar-fixed-top">
    <div style="margin: 5px 50px 0 20px; width: 5%" class="navbar-left pull-left">
        <img src="images/agritrade.png" height="40">
    </div>

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="navbar-collapse collapse" id="nav">
        <form class="navbar-form navbar-left" role="search" method="get" action="farmer-search.php" id="search">
            <div class="form-group">
                <input type="search" class="form-control" name="search" placeholder="enter keyword....">
            </div>

            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </form>

        <div class="navbar-right">
                <span style="color: whitesmoke; margin: 15px 25px 0 0">Welcome <?php echo $farmerRow['username'] ?>
                    <a role="button" class="btn btn-danger" title="logout" href="logout.php?page=dashboard">
                        <i class="fa fa-power-off"></i>
                    </a>
                </span>
        </div>
    </div>
</nav>

<div id="dialog">
    <div class="alert alert-success">
        <p class="text-center">
            <span class="glyphicon glyphicon-ok"></span>
            Thanks <strong><?php echo $farmerRow['username'] ?></strong>.
            Your bid has been set. The buyer can now contact you.
            <span class="pull-right" id="dialogClose" style="background-color: #5cb85c; cursor: pointer; padding: 2px 4px 2px 4px; border-radius: 4px"><i class="fa fa-close"></i></span>
        </p>
    </div>
</div>
<div id="error-dialog">

</div>

<ol class="breadcrumb panel">
    <li>Dashboard </li>
    <li><a href="farmer-dashboard.php">Farmer</a></li>
</ol>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="row post" id="formDiv">
                <form enctype="multipart/form-data" id="farmerProductForm">
                    <div id="farmerProductError">

                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-signin">
                                <h4 class="text-center">Quantity</h4>
                                <p class="help-block text-center">Please add the unit of measurement eg. kilos, bags, boxes</p>
                                <input type="text" name="productQuantity" class="form-control" id="productQuantity" placeholder="Enter quantity eg: 20 boxes" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-signin">
                                <h4 class="text-center">Add Pictures of product</h4>
                                <hr>
                                <label id="pic-label" for="pic-file" class="btn btn-primary"><i class="glyphicon glyphicon-folder-open"></i> &nbsp; browse</label>
                                <input  type="file" name="file[]" class="btn btn-file hidden" id="pic-file" multiple required><br>
                               <br>
                                <div class="row" id="append-value">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-signin">
                            <h4 class="text-center">Description</h4>
                            <textarea class="form-control" rows="12" name="productDescription" id="productDescription" placeholder="Add description of product" required></textarea>
                        </div>
                    </div>

                    <button style="margin: 20px" type="submit" class="btn btn-primary pull-right" name="submitFarmerProduce" id="submitFarmerProduce">
                        <span class="fa fa-send-o"></span> &nbsp; post
                    </button>
                </form>
            </div>


            <div class="row">
                <?php
                $query = mysqli_query($con,"SELECT * FROM buyer_market ORDER BY b_m_id DESC");
                while($productRow = mysqli_fetch_array($query)){
                    $buyer = $productRow['Buyer_Id'];
                    $buyerMarkId = $productRow['b_m_id'];

                    $sql_query = mysqli_query($con, "SELECT * FROM buyer WHERE Buyer_Id = '$buyer'");
                    $buyerRow = mysqli_fetch_array($sql_query);

                    $bid_query = mysqli_query($con, "SELECT * FROM bids WHERE Farm_Id = '$farmerID' AND b_m_id ='$buyerMarkId'");
                    $numOfBids = mysqli_num_rows($bid_query);
                    $date = $productRow['deadline_month'].' '.$productRow['deadline_day'].', '.$productRow['deadline_year'];
                    $currentDate = date('F j, Y');
                    ?>
                    <div class="col-sm-6">
                    <div class="form-signin" style="color: #333; min-height: 300px;">
                        <p><strong>Product: </strong><?php echo $productRow['description'] ?></p>
                        <p><strong>Quantity: </strong><?php echo $productRow['quantity'] ?></p>
                        <p><strong>Deadline: </strong><?php echo $date ?></p>
                        <p class="small"><small><strong>Posted on: </strong><?php echo $productRow['time_posted'] ?></small></p>
                        <p class="small"><small><strong>Posted by: </strong><?php echo $buyerRow['full_name'] ?></small></p>
                        <hr>
                        <?php
                        if ($numOfBids > 0){
                            ?>
                            <button class="btn btn-primary btn-sm pull-right" disabled><span class="fa fa-thumbs-up"></span> bid made</button>
                            <?php
                        }
                        elseif($currentDate > $date){
                            ?>
                            <button class="btn btn-primary btn-sm pull-right" disabled><span class="fa fa-close"></span> deadline reached</button>
                            <?php
                        }
                        else {
                            ?>
                            <button class="btn btn-primary btn-sm pull-right make-bid" id="bid-<?php echo $buyerMarkId ?>">
                                <span class="fa fa-bullhorn"></span> bid
                            </button>
                            <?php
                        }
                        ?>
                        <br>
                    </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-sm-3" >
            <div class="form-signin">
                <h3 class="text-center">Your recent posts</h3>
            </div>
            <div id="append-new-post">

            <?php
            $farmerID = $_SESSION['farmer_logged'];
            $post_query = mysqli_query($con, "SELECT * FROM farmer_market WHERE Farm_Id = '$farmerID'  ORDER BY f_m_id DESC LIMIT 5");


            while ($postRow = mysqli_fetch_array($post_query)){
                $postId = $postRow['f_m_id'];

                $select_query = mysqli_query($con, "SELECT * FROM product_pictures WHERE f_m_id = '$postId'");
                $numOfPics = mysqli_num_rows($select_query);
                $newNum = $numOfPics - 1;

                $file = array($numOfPics);
                $i = 0;
                while ($picRow = mysqli_fetch_array($select_query)){
                    $file[$i] = $picRow['file_name'];
                    $i++;
                }

                ?>
                <div class="form-signin" style="color: #333">
                    <input type="hidden" value="<?php echo $numOfPics ?>" id="num-<?php echo $postRow['f_m_id']?>">
                    <img src="uploads/<?php echo $file[0]?>" class="img-responsive center-block img-thumbnail initiate-swipe swipe-class-0-<?php echo $postRow['f_m_id'] ?>" id="swipe-<?php echo $postRow['f_m_id'] ?>" align="center" alt="<?php echo $postRow['description']?>">
                    <?php
                    for ($j = 1; $j < $numOfPics; $j++){
                        ?>
                        <img src="uploads/<?php echo $file[$j]?>" class="img-responsive center-block img-thumbnail initiate-swipe hidden swipe-class-<?php echo $j ?>-<?php echo $postRow['f_m_id'] ?>" id="swipe-<?php echo $postRow['f_m_id'] ?>" align="center" alt="<?php echo $postRow['description']?>">
                        <?php
                    }
                    ?>
                    <a href="#" class="small"><?php echo $newNum?> more picture(s)</a>
                    <br>
                    <br>
                    <p><strong>Product: </strong><?php echo $postRow['description'] ?></p>
                    <p><strong>Quantity: </strong><?php echo $postRow['quantity'] ?></p>
                    <p class="small"><small><strong>Posted on:</strong> <?php echo $postRow['date_posted']?></small></p>
                    <hr>
                    <div class="clearfix">
                        <button class="btn btn-primary pull-left btn-sm update" id="update-<?php echo $postRow['f_m_id'] ?>"><span class="fa fa-edit"></span> edit</button>
                        <button class="btn btn-danger pull-right btn-sm" data-toggle="modal" data-target="#modal-<?php echo $postRow['f_m_id'] ?>"><span class="fa fa-trash"></span> delete</button>
                    </div>
                </div>

                <div class="modal fade" id="modal-<?php echo $postRow['f_m_id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                                <h3 class="modal-title">Delete Post</h3>
                            </div>

                            <div class="modal-body" id="deleteModalDiv-<?php echo $postRow['f_m_id'] ?>">
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
                                    <button type="button" class="btn btn-danger delete pull-right" id="delete-<?php echo $postRow['f_m_id'] ?>">
                                        <span class="fa fa-trash"></span> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>

</body>

</html>