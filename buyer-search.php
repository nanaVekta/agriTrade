<?php session_start();
require_once 'dbconfig.php';
include_once 'functions.php';

if(!isset($_SESSION['buyer_logged'])){
    redirect_to('index.php');
}
else {
    $buyerID = $_SESSION['buyer_logged'];
    $sql = mysqli_query($con, "SELECT * FROM buyer WHERE Buyer_Id = '$buyerID'");
    $buyerRow = mysqli_fetch_array($sql);

    $bid_query = mysqli_query($con, "SELECT * FROM bids WHERE bid_read = '0' AND Buyer_Id = '$buyerID'");
    $numOfUnread = mysqli_num_rows($bid_query);
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
            <a href="buyer-dashboard.php">
                <img src="images/agritrade.png" height="40">
            </a>
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
                    <input type="search" class="form-control" name="search" placeholder="search for a farmer....">
                </div>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>

            <?php
            if ($numOfUnread > 0) {
                ?>
                <div class="navbar-left" style="margin-left: 70px; cursor: pointer">
                    <h3 class="text-center unreadBids" style="color: white" id="unreadBids-<?php echo $buyerID ?>"
                        data-toggle="modal" data-target="#bids-modal">
                        <span class="fa fa-bullhorn" title="View Bids"></span>
                        <span class="badge" style="background-color: red"><?php echo $numOfUnread ?></span>
                    </h3>
                </div>
                <?php
            } else {
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
                    while ($bidRow = mysqli_fetch_array($bid_query)) {
                        $farmerId = $bidRow['Farm_Id'];
                        $marketId = $bidRow['b_m_id'];

                        $farmer_bid_query = mysqli_query($con, "SELECT * FROM farmer WHERE Farm_Id = '$farmerId'");
                        $farmerBidRow = mysqli_fetch_array($farmer_bid_query);

                        $market_query = mysqli_query($con, "SELECT * FROM buyer_market WHERE b_m_id = '$marketId'");
                        $marketRow = mysqli_fetch_array($market_query);
                        if ($bidRow['bid_read'] == 0) {
                            ?>
                            <div class="form-signin center-block" style="color: #333; background-color: #f5f5f5">
                                <h4><span class="label label-danger">New</span></h4>
                                <p>
                                    <strong><?php echo $farmerBidRow['full_name'] ?></strong> made a bid for your post,
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
                                    <span class="fa fa-phone"></span>
                                    <strong><?php echo $farmerBidRow['contact_number'] ?></strong>
                                </p>
                            </div>
                            <hr>
                            <?php
                        } else {
                            ?>
                            <div class="form-signin center-block" style="color: #333">
                                <p>
                                    <strong><?php echo $farmerBidRow['full_name'] ?></strong> made a bid for your post,
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
                                    <span class="fa fa-phone"></span>
                                    <strong><?php echo $farmerBidRow['contact_number'] ?></strong>
                                </p>
                            </div>
                            <hr>
                            <?php
                        }
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

    <?php

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $search_query = mysqli_query($con, "SELECT * FROM farmer_market WHERE description LIKE '%$search%' OR quantity LIKE '%$search%'");
        $numOfSearchRows = mysqli_num_rows($search_query);
        ?>

        <ol class="breadcrumb panel">
            <li>Market</li>
            <li><a href="buyer-dashboard.php">Buyer</a></li>
            <li>Search</li>
            <li><?php echo $search ?></li>
        </ol>
        <h3 class="text-center">You searched for <em style="color: green;"><strong><?php echo $search ?></strong></em></h3>
        <hr>
        <br>
        <?php
        if($numOfSearchRows < 1){
            ?>
            <h1 class="text-center">Sorry no records found</h1>
            <?php
        }else{
            ?>
            <div class="container">
                <div class="row">
                    <?php
                    while ($postRow = mysqli_fetch_array($search_query)){
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
                        <div class="col-sm-4">
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
            <?php
        }
        ?>

        </body>

        </html>
        <?php
    }
    else {
        echo '<h1 class="text-center">No keyword found</h1>';
    }
}