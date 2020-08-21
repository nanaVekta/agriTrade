<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(!isset($_SESSION['buyer_logged'])){
    redirect_to('index.php');
}

$buyerID = $_SESSION['buyer_logged'];
$sql = mysqli_query($con,"SELECT * FROM buyer WHERE Buyer_Id = '$buyerID'");
$buyerRow = mysqli_fetch_array($sql);

$bid_query = mysqli_query($con, "SELECT * FROM bids WHERE bid_read = '0' AND Buyer_Id = '$buyerID'");
$numOfUnread = mysqli_num_rows($bid_query);

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <title>AgriTrade | Buy and sell all agricultural products online</title>
    <meta charset="UFT-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Buy and sell all agricultural products online">
    <link rel="icon" href="images/agritrade-icon.png">
    <link rel="stylesheet" media="all" type="text/css" href="css/style.css">
    <link href="css/bootstrap.css" rel="stylesheet" media="all" type="text/css">
    <link href="css/fileinput.css" rel="stylesheet" media="all" type="text/css">
    <link href="css/swipebox.css" rel="stylesheet" media="all" type="text/css">
    <link href="fontawesome/css/font-awesome.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="js/buyer.js"></script>
    <script type="text/javascript" src="js/fileinput.js"></script>
    <script type="text/javascript" src="js/jquery.swipebox.js"></script>
    <script type="text/javascript" src="js/swipe.js"></script>
</head>
<body style="margin-top: 60px; background-color: #f5f5f5">

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
        <form class="navbar-form navbar-left" role="search" method="get" action="buyer-search.php" id="search">
            <div class="form-group">
                <input type="search" class="form-control" name="search" placeholder="enter keyword....">
            </div>

            <button type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </form>

        <?php
        if($numOfUnread > 0) {
            ?>
            <div class="navbar-left" style="margin-left: 70px; cursor: pointer">
                <h3 class="text-center unreadBids" style="color: white" id="unreadBids-<?php echo $buyerID ?>" data-toggle="modal" data-target="#bids-modal">
                    <span class="fa fa-bullhorn" title="View Bids"></span>
                    <span class="badge" style="background-color: red"><?php echo $numOfUnread ?></span>
                </h3>
            </div>
            <?php
        }
        else{
            ?>
            <div class="navbar-left" style="margin-left: 70px; cursor: pointer">
                <h3 class="text-center" style="color: white" data-toggle="modal" data-target="#bids-modal">
                    <span class="fa fa-bullhorn" title="View Bids"></span>
                </h3>
            </div>
        <?php
        }
        ?>

        <div class="navbar-right">
                <span style="color: whitesmoke; margin: 15px 25px 0 0">Welcome <?php echo $buyerRow['username'] ?>
                    <a role="button" class="btn btn-danger" title="logout" href="logout.php?page=dashboard">
                        <i class="fa fa-power-off"></i>
                    </a>
                </span>
        </div>
    </div>
</nav>

<div class="modal fade" id="bids-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                <h3 class="modal-title" style="color: green">Bids</h3>
            </div>

            <div class="modal-body">

                    <?php
                    $bid_query = mysqli_query($con, "SELECT * FROM bids WHERE Buyer_Id = '$buyerID' ORDER BY bid_id DESC");
                    $numOfBids = mysqli_num_rows($bid_query);
                    if($numOfBids > 0){
                        while($bidRow = mysqli_fetch_array($bid_query)){
                            $farmerId = $bidRow['Farm_Id'];
                            $marketId = $bidRow['b_m_id'];

                            $farmer_bid_query = mysqli_query($con,"SELECT * FROM farmer WHERE Farm_Id = '$farmerId'");
                            $farmerBidRow = mysqli_fetch_array($farmer_bid_query);

                            $market_query = mysqli_query($con,"SELECT * FROM buyer_market WHERE b_m_id = '$marketId'");
                            $marketRow = mysqli_fetch_array($market_query);
                            if($bidRow['bid_read'] == 0){
                                ?>
                                <div class="form-signin center-block" style="color: #333; background-color: #f5f5f5">
                                    <h4><span class="label label-danger">New</span></h4>
                                    <p>
                                        <strong><?php echo $farmerBidRow['full_name']?></strong> made a bid for your post,
                                    </p>
                                    <p>
                                        <span class="fa fa-quote-left" style="color: green"></span>
                                        <strong>
                                            <?php echo $marketRow ['description'] ?>
                                            of quantity <?php echo $marketRow['quantity'] ?>
                                        </strong>
                                        <span class="fa fa-quote-right" style="color: green"></span>
                                    </p>
                                    <p>
                                        on <?php echo $bidRow['bid_date'] ?>
                                    </p>
                                    <p>
                                        <span class="fa fa-phone"></span> <strong><?php echo $farmerBidRow['contact_number'] ?></strong>
                                    </p>
                                </div>
                                <hr>
                                <?php
                            }
                            else{
                                ?>
                                <div class="form-signin center-block" style="color: #333">
                                    <p>
                                        <strong><?php echo $farmerBidRow['full_name']?></strong> made a bid for your post,
                                    </p>
                                    <p>
                                        <span class="fa fa-quote-left" style="color: green"></span>
                                        <strong>
                                            <?php echo $marketRow ['description'] ?>
                                            of quantity <?php echo $marketRow['quantity'] ?>
                                        </strong>
                                        <span class="fa fa-quote-right" style="color: green"></span>
                                    </p>
                                    <p>
                                        on <?php echo $bidRow['bid_date'] ?>
                                    </p>
                                    <p>
                                        <span class="fa fa-phone"></span> <strong><?php echo $farmerBidRow['contact_number'] ?></strong>
                                    </p>
                                </div>
                                <hr>
                                <?php
                            }
                        }
                    }
                    else{
                        ?>
                        <h3 class="text-center">No bids received</h3>
                <?php
                    }
                    ?>

             </div>

            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="fa fa-close"></span> Close
                    </button>
            </div>
        </div>
    </div>
</div>


<ol class="breadcrumb panel">
    <li>Market</li>
    <li>Buyer</li>
</ol>

<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="row post" id="formDiv">
                <form id="productForm">
                    <div id="buyerProductError">

                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="form-signin">
                                <h4 class="text-center">Set Deadline</h4>
                                <div class="col-sm-4">
                                    <select name="durationDay" id="durationDay" class="form-control" required>
                                        <option value="" selected disabled>--Day--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select  class="form-control" id="durationMonth" name="durationMonth" required>
                                        <option value=""  selected disabled>--Month--</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select  class="form-control" id="durationYear" name="durationYear" required>
                                        <option value=""  selected disabled>--Year--</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-signin">
                                <h4 class="text-center">Quantity</h4>
                                <p class="help-block text-center">Please add the unit of measurement eg. kilos, bags, boxes</p>
                                <input type="text" name="productQuantity" class="form-control" id="productQuantity" placeholder="Enter quantity needed eg: 20 boxes" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-signin">
                            <h4 class="text-center">Description</h4>
                            <textarea class="form-control" rows="10" name="productDescription" id="productDescription" placeholder="Add description of product needed" required></textarea>
                        </div>
                    </div>

                    <button style="margin: 20px" type="submit" class="btn btn-primary pull-right" name="submitBuyerProduce" id="submitBuyerProduce">
                        <span class="fa fa-send-o"></span> &nbsp; post
                    </button>
                </form>
            </div>

            <div class="row">
                <?php
                $post_query = mysqli_query($con, "SELECT * FROM farmer_market");


                while ($postRow = mysqli_fetch_array($post_query)){
                    $farmer = $postRow['Farm_Id'];
                    $farmer_query = mysqli_query($con, "SELECT * FROM farmer WHERE Farm_Id = '$farmer'");
                    $farmerRow = mysqli_fetch_array($farmer_query);

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
                    <div class="col-sm-6">
                    <div class="form-signin" style="color: #333; min-height: 600px;">
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
                        <p class="small"><small><strong>Posted by:</strong> <?php echo $farmerRow['full_name']?></small></p>
                        <hr>
                        <div class="clearfix">
                            <button class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#farmer-modal-<?php echo $postRow['f_m_id'] ?>"><span class="fa fa-phone"></span> contact farmer</button>
                        </div>
                    </div>
                    </div>

                    <div class="modal fade" id="farmer-modal-<?php echo $postRow['f_m_id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                                    <h3 class="modal-title" style="color: green">Farmer Info</h3>
                                </div>

                                <div class="modal-body">
                                    <div class="form-signin center-block" style="color:#333">
                                        <p>
                                            <span class="fa fa-user-md"></span> &nbsp; &nbsp; <?php echo $farmerRow['full_name'] ?>
                                        </p>
                                        <p>
                                            <span class="fa fa-map-marker"></span> &nbsp; &nbsp; <?php echo $farmerRow['town'] ?>, <?php echo $farmerRow['district'] ?>, <?php echo $farmerRow['region'] ?>
                                        </p>
                                        <p>
                                            <span class="fa fa-phone"></span> &nbsp; &nbsp; <?php echo $farmerRow['contact_number'] ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                        <span class="fa fa-close"></span> Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="panel">
                <h3 class="text-center" style="color: green">Recent Posts</h3>
            </div>
            <div id="append-new-post">
                <?php
                $query = mysqli_query($con,"SELECT * FROM buyer_market WHERE Buyer_Id = '$buyerID' ORDER BY b_m_id DESC LIMIT 5");
                while($productRow = mysqli_fetch_array($query)){
                    ?>
                    <div class="form-signin" style="color: #333">
                        <p><strong>Product: </strong><?php echo $productRow['description'] ?></p>
                        <p><strong>Quantity: </strong><?php echo $productRow['quantity'] ?></p>
                        <p><strong>Deadline: </strong><?php echo $productRow['deadline_month'].' '.$productRow['deadline_day'].', '.$productRow['deadline_year'] ?></p>
                        <p class="small"><strong>Posted on: </strong><?php echo $productRow['time_posted'] ?></p>
                        <hr>
                        <div class="clearfix">
                            <button class="btn btn-primary pull-left update" id="update-<?php echo $productRow['b_m_id'] ?>"><span class="fa fa-edit"></span> edit</button>
                            <button class="btn btn-danger pull-right" id="delete" data-toggle="modal" data-target="#modal-<?php echo $productRow['b_m_id'] ?>"><span class="fa fa-trash"></span> delete</button>
                        </div>
                    </div>

                    <div class="modal fade" id="modal-<?php echo $productRow['b_m_id'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                                    <h3 class="modal-title">Delete Post</h3>
                                </div>

                                <div class="modal-body" id="deleteModalDiv-<?php echo $productRow['b_m_id'] ?>">
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
                                        <button type="button" class="btn btn-danger delete pull-right" id="delete-<?php echo $productRow['b_m_id'] ?>">
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