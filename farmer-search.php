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

<?php

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search_query = mysqli_query($con, "SELECT * FROM buyer_market WHERE description LIKE '%$search%' OR quantity LIKE '%$search%' OR deadline_day LIKE '%$search%' OR deadline_month LIKE '%$search%' OR deadline_year LIKE '%$search%'");
    $numOfSearchRows = mysqli_num_rows($search_query);
    ?>

    <div id="dialog">
        <div class="alert alert-success">
            <p class="text-center">
                <span class="glyphicon glyphicon-ok"></span>
                Thanks <strong><?php echo $farmerRow['username'] ?></strong>.
                Your bid has been set. The buyer can now contact you.
                <span class="pull-right" id="dialogClose"
                      style="background-color: #5cb85c; cursor: pointer; padding: 2px 4px 2px 4px; border-radius: 4px"><i
                        class="fa fa-close"></i></span>
            </p>
        </div>
    </div>
    <div id="error-dialog">

    </div>

    <ol class="breadcrumb panel">
        <li>Dashboard</li>
        <li><a href="farmer-dashboard.php">Farmer</a></li>
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
                while($productRow = mysqli_fetch_array($search_query)){
                    $buyer = $productRow['Buyer_Id'];
                    $buyerMarkId = $productRow['b_m_id'];

                    $sql_query = mysqli_query($con, "SELECT * FROM buyer WHERE Buyer_Id = '$buyer'");
                    $buyerRow = mysqli_fetch_array($sql_query);

                    $bid_query = mysqli_query($con, "SELECT * FROM bids WHERE Farm_Id = '$farmerID' AND b_m_id ='$buyerMarkId'");
                    $numOfBids = mysqli_num_rows($bid_query);
                    $date = $productRow['deadline_month'].' '.$productRow['deadline_day'].', '.$productRow['deadline_year'];
                    $currentDate = date('F j, Y');
                    ?>
                    <div class="col-sm-4">
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
                            elseif($currentDate < $date){
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
<?php
    }
}else{
    echo '<h1 class="text-center">No keyword found</h1>';
}
?>
</body>

</html>