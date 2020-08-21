
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
    <link href="fontawesome/css/font-awesome.css" rel="stylesheet" media="all" type="text/css">
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>

<body style="margin-top: 45px">

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
        <ul class="nav navbar-nav">
            <li class="active link"><a href="index.php"> home</a> </li>
            <li class="link" id="serviceLink"><a href="#services"> services</a> </li>
            <li class="link" id="aboutLink"><a href="#aboutUs"> about us</a></li>
        </ul>


        <ul class="nav navbar-nav navbar-right">
            <li data-toggle="modal" data-target="#loginModal"><a style="cursor: pointer"><span class="fa fa-sign-in"></span> &nbsp;Login</a> </li>
            <li data-toggle="modal" data-target="#SignUpModal"><a style="cursor: pointer"><span class="fa fa-edit"></span> &nbsp;Sign-Up</a> </li>
            <li><a></a> </li>
            <li></li>
        </ul>
    </div>
   </nav>

   <div id="indexCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
       <ol class="carousel-indicators">
           <li data-target="indexCarousel" data-slide-to="0" class="active"></li>
           <li data-target="indexCarousel" data-slide-to="1"></li>
           <li data-target="indexCarousel" data-slide-to="2"></li>
           <li data-target="indexCarousel" data-slide-to="3"></li>
           <li data-target="indexCarousel" data-slide-to="4"></li>
           <li data-target="indexCarousel" data-slide-to="5"></li>
           <li data-target="indexCarousel" data-slide-to="6"></li>
           <li data-target="indexCarousel" data-slide-to="7"></li>
           <li data-target="indexCarousel" data-slide-to="8"></li>
       </ol>
       <div class="carousel-inner">
           <div class="item active" align="center">
                <img src="images/carousel1.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel2.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel3.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel4.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel5.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel6.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel7.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel8.jpg" class="img-responsive">
           </div>

           <div class="item" align="center">
               <img src="images/carousel9.jpg" class="img-responsive">
           </div>


           <a href="#indexCarousel" class="carousel-control right" data-slide="next">
               <span class="glyphicon glyphicon-chevron-right"></span>
           </a>
           <a href="#indexCarousel" class="carousel-control left" data-slide="prev">
               <span class="glyphicon glyphicon-chevron-left"></span>
           </a>
       </div>

   </div>



   <br><br>

<main class="container">
    <div class="row" id="services">
        <div class="col-sm-6">
            <div class="round-block">
                    <img src="images/buy-and-sell.png" align="center" class="img-responsive serviceImg center-block">

                <h1 class="text-center"><strong>What is agriTrade?</strong></h1>
                <p style="font-size: 150%">
                    AgriTrade arises with the purpose of allowing a
                    direct communication between sellers and
                    buyers, facilitating
                    immediate trade and in accordance with the
                    needs of all parties involved.

                    The flow of information allows the construction of
                    prices in a transparent ecosystem
                    and the convenience of being able to carry out transactions from anywhere
                    in the world where you have internet connection.
                </p>
                <br><br>
            </div>

        </div>


        <div class="col-sm-6">
            <div class="round-block">
                <img src="images/buyer-meets-seller.png" align="center" class="img-responsive serviceImg center-block">

                <h1 class="text-center"><strong>How it works?</strong></h1>
                <p style="font-size: 150%">
                   A buyer uploads his requirements of a product he wants to buy and a farmer also
                    uploads details of his products ready for sale.
                    Our job is to link the buyer to the farmer for easy transaction.
                    We also transport goods from the farmer to the buyer on the request of
                    the buyer at a reduced cost.
                </p>
            </div>

        </div>
    </div>

    <div class="row" id="aboutUs">
        <h1 class="text-center"><strong>How to join?</strong></h1>

        <div class="col-sm-6">
            <div class="how-to">
                <div class="row">
                    <h2 class="text-center"> Farmer</h2>
                    <hr>
                    <div class="col-sm-4">
                        <img src="images/farmer.png" class="img-responsive center-block">
                    </div>
                    <div class="col-sm-8" style="border-left: 2px solid white">
                        <p style="font-size: 120%">
                            Fill a form by clicking on the button below and providing your details. We only need:
                        </p>
                        <ul class="requirements">
                            <li>Your full name or farm name</li>
                            <li>Your username [chosen by you]</li>
                            <li>Your password [chosen by you]</li>
                            <li>Your location [i.e town, district and region]</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-sm-6">
            <div class="how-to">
                <div class="row">
                    <h2 class="text-center"> Buyer</h2>
                    <hr>
                    <div class="col-sm-4">
                        <img src="images/buyer.png" class="img-responsive center-block">
                    </div>
                    <div class="col-sm-8" style="border-left: 2px solid white">
                        <p style="font-size: 120%">
                            Fill a form by clicking on the button below and providing your details. We only need:
                        </p>
                        <ul class="requirements">
                            <li>Your full name or company name</li>
                            <li>Your username [chosen by you]</li>
                            <li>Your password [chosen by you]</li>
                            <li>Your location [i.e town, district and region]</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="clear"></div>
        <br>

        <div class="center-block">
            <button class="btn btn-primary btn-lg logIn center-block" data-toggle="modal" data-target="#SignUpModal"><span class="fa fa-sign-in"></span> Join</button>
        </div>
    </div>
</main>


<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                <h4 class="modal-title">Login</h4>
            </div>

            <div class="modal-body" id="loginDiv">
                <form class="form-signin center-block" id="farmerLoginForm">
                    <h3 class="text-center form-signin-heading">Farmer's Login</h3>
                    <div id="farmerLoginError">

                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span> </span>
                            <input type="text" class="form-control" id="farmerUserName" name="farmerUserName" placeholder="Please input your username" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-key"></span> </span>
                            <input type="password" class="form-control" id="farmerUserPassword" name="farmerUserPassword" placeholder="Please input your password" required>
                        </div>
                    </div>
                    <hr>

                    <div class="clearfix">
                        <button type="submit" class="btn btn-primary pull-right" id="farmerSubmitLogin" name="farmerSubmitLogin"><span class="fa fa-send"></span> &nbsp;Log In</button>
                    </div>

                </form>
            </div>

            <div class="modal-footer" id="loginFooter">
                <p class="text-center"><a href="#" id="loadBuyerLogin">Click here</a> to log in as buyer</p>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="SignUpModal" tabindex="-1">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button class="close" data-dismiss="modal"><span class="fa fa-close"></span></button>
                   <h4 class="modal-title">Sign Up</h4>
               </div>

               <div class="modal-body" id="farmerSignUpDiv">
                   <form class="form-signin center-block" id="farmerSignUpForm">
                       <h3 class="text-center form-signin-heading">Farmer's Info</h3>

                       <div id="farmerSignUpError">

                       </div>

                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><span class="fa fa-user"></span> </span>
                               <input type="text" class="form-control" id="farmerSignUpFullName" name="farmerSignUpFullName" placeholder="Please input your full name" required>
                           </div>
                       </div>


                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><span class="fa fa-user"></span> </span>
                               <input type="text" class="form-control" id="farmerSignUpUserName" name="farmerSignUpUserName" placeholder="Please input your username" required>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><i class="fa fa-female"></i></span>
                               <select  class="form-control" id="farmerSignUpGender" name="farmerSignUpGender" required>
                                   <option value=""  selected disabled>----Select Gender----</option>
                                   <option value="female">Female</option>
                                   <option value="male">Male</option>
                               </select>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><span class="fa fa-key"></span> </span>
                               <input type="password" class="form-control" id="farmerSignUpPassword" name="farmerSignUpPassword" placeholder="Please input your password" required>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><span class="fa fa-key"></span> </span>
                               <input type="password" class="form-control" id="farmerConfirmSignUpPassword" name="farmerConfirmSignUpPassword" placeholder="Confirm your password" required>
                           </div>
                       </div>

                       <div class="form-group">
                           <div class="input-group">
                               <span class="input-group-addon"><span class="fa fa-phone"></span> </span>
                               <input type="text" class="form-control" id="farmerContact" name="farmerContact" placeholder="Enter Contact number" required>
                           </div>
                       </div>

                       <hr>

                       <div class="clearfix">
                           <button type="submit" class="btn btn-primary pull-right" id="farmerSubmitSignUp" name="farmerSubmitSignUp"><span class="fa fa-arrow-right"></span> &nbsp;Next</button>
                       </div>
                   </form>
               </div>
               <div class="modal-footer" id="signUpFooter">
                   <p class="text-center"><a href="#" id="loadBuyerSignUp">Click here</a> to sign up as buyer</p>
               </div>

           </div>
       </div>
   </div>
<br>

</body>
<footer>
    <div class="container">
        s
        <div class="row">
            <h2 class="text-center">Our Hallmark</h2>
            <div class="col-sm-3">
                <h3 class="text-center">Efficiency</h3>
                <p>
                    AgriTrade allows buyers and sellers of agricultural produce to interact directly
                    in the shortest possible time, lowering sales costs and increasing profit for
                    both parties. All this can be done stress free!
                </p>
            </div>

            <div class="col-sm-3">
                <h3 class="text-center">Information</h3>
                <p>
                    AgriTrade offers buyers the largest inventory of agricultural produce
                    in the country and to sellers a greater exhibition of their merchandise
                    with transparent prices. The price you are looking for is at AgriTrade!
                </p>
            </div>

            <div class="col-sm-3">
                <h3 class="text-center">Security</h3>
                <p>
                    AgriTrade operations are backed by physical and electronic contracts.
                    Our priority is to provide security and trust to all transactions carried out
                    on the site, penalizing breaches and promoting good business practices.
                </p>
            </div>

            <div class="col-sm-3">
                <h3 class="text-center">Freight</h3>
                <p>
                    AgriTrade offers a professional and safe service of freight to
                    facilitate the sale process and help get the best possible price.
                    That is we transport the goods bought from the farmer to the buyer
                    on the request of the buyer at an affordable price.
                </p>
            </div>
        </div>
    <hr>

        <div class="row">

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-facebook-square"></span> &nbsp;agriTrade Inc. &nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-twitter-square"></span> &nbsp;agriTrade Inc. &nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-instagram"></span> &nbsp;agriTrade &nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-inbox"></span> &nbsp;agritradeghana@gmail.com &nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-phone"></span> &nbsp;0242255334 &nbsp;&nbsp;&nbsp;&nbsp;
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <p class="text-center">
                    <span class="fa fa-map-marker"></span> &nbsp;No 64, Residency, Sunyani
                </p>
            </div>

        </div>

<hr>

    <p class="text-center">
        &copy; agriTrade 2017 | All rights reserved
    </p>
    </div>

</footer>
</html>