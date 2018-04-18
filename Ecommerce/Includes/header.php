<?php
session_start();
require_once('connection.php');
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     
    <title>BestBuy.com</title>
</head>

<body>
    <!--  <ContainFluid>-->
    <div class="container-fluid">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 d-none d-sm-block">
                        <span class="text-success"><i class="fa fa-tag" aria-hidden="true"></i> Enjoy <strong> for Sampath Credit & Debit Cards</strong></span>
                    </div>

                    <div class="col-sm-6 col-xs-12  d-flex justify-content-sm-center text-right">
                        <ul id="top-bar-links">
                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="#contactUs.php">0117 53 53 53</a></li>
                            <li> <i class="fa fa-hashtag" aria-hidden="true"></i>
                                <a href="#" data-toggle="modal" data-target="#modal-track-order">Track Your Order</a>
                            </li>
                            <?php
                            //When user signs in...
                            if(isset($_SESSION["user_name"]))
                            {
                                ?>
                                <li><i class="fa fa-sign-out" aria-hidden="true">&nbsp;<a href="logout.php">Sign Out</a></i></li>
                                <?php
                            }
                            else {
                                //When a user signs out..
                                ?>
                                <li><i class="fa fa-user" aria-hidden="true"></i> <a href="#signUp" data-toggle="modal">Login /Register</a></li>
                                <?php
                            }
                            ?>
                            
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--     <///ContainerFluid>-->

    <!--   <LogoBar>-->
    <div class="row" id="logo-bar">
    </div>
    <!--   <//LogoBar>-->
    <!--        <Header>  -->
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 py-3">
                    <span class="expert-link text">
                     <a href="#expert-service"><i>Expert Service. Unbeatable Price</i></a>
                </span>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 py-3">
                    <ul class="nav-list">
                        <li><a href="WeeklyAd">Weekly Ad</a></li>
                        <li><a href="Deal">Deal of the Day</a></li>
                        <li><a href="credit">Credit cards</a></li>
                        <li><a href="Gifts">Gift Cards</a></li>
                        <li><a href="GiftIdeas">Gift Ideas</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="d-flex flex-row">
                        <div class="align-self-start">
                            <img src="images/bestbuy.png" alt="" class="img-fluid">
                        </div>
                        <div class=" py-2 align-self-end">
                            <div class="search-bar">
                                <h3 class="display-5">Best Buy Lanka</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="d-flex flex-row" id="time-row">
                        <div class="px-5 align-self-start">
                            <i class="fa fa-home" aria-hidden="true"></i> <span>Opening at :10AM</span>
                        </div>
                        <div class="px-5">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            <span>Cart</span>&nbsp;<span class="badge badge-danger">0</span>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <//Header>-->
    <!--Nav-->
    <nav class="navbar navbar-expand-sm navbar-dark">
        <div class="container">
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
             <span class="navbar-toggler-icon"></span>
         </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="Index.php" class="nav-link"><strong class="text-white">PRODCUTS</strong></a>
                    </li>
                    <li class="navbar-item">
                        <a href="#" class="nav-link"><strong class="text-white">BRANDS</strong></a>
                    </li>
                    <li class="navbar-item">
                        <a href="#" class="nav-link"><strong class="text-white">DEALS</strong></a>
                    </li>
                    <li class="navbar-item">
                        <a href="#" class="nav-link"><strong class="text-white">SERVICES</strong></a>
                    </li>
                    
                </ul>
                
               
                  
                <form class="form-inline ml-auto" id="searchArea">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search by name" id="searchBox" required> 
                  <input type="button" class="btn btn-outline-success my-2 my-sm-0" id="searchButton" value="Search">
                  
                </form>
                
               <?php
                if(isset($_SESSION['user_name'])){
                    ?>
                     <ul class="px-2 navbar-nav" id="account">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown" id="account">
                           <i aria-hidden="true" class="fa fa-user-circle-o"></i>
                            <?php
                            if(isset($_SESSION["user_name"])){
                                echo strtoupper($_SESSION["user_name"]);
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu">
        <a class="dropdown-item" href="card.php"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
Cart</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#changePassword" href="javascript:void(0)">Change Password</a>
        <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
                    </li>
                </ul>
                    
                    <?php
                }
               
                ?>
                 
            </div>
        </div>
    </nav>
    <!--<//Nav>-->
