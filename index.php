<?php
require_once 'db_functions.php';
session_start();
if(isset($_SESSION["cart"])){
    $cart= $_SESSION["cart"];
}else{
    $cart=null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Get Started - E-Shop</title>
	<link rel="icon" type="image/ico" href="images/favicon.ico">
	<meta name="keywords" content="eshop, dolls, ty">
	<meta name="description" content="The main page of the E-Shop page.">
	<meta name="author" content="Konstantina Gkritsa, Filotas Sismanis">
    <link rel="stylesheet" type="text/css" href="backgroundStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<div id="main-container">
    <header>
        <nav>
            <ul id="nav-ul">
                <li class="nav-li-left"><a href="index.php" title="Home"><i class="fa fa-fw fa-home"></i></a></li>
                <li class="nav-li-left"><a href="allProducts.php" title="Products">Products</a></li>
                <li class="nav-li-right"><a href="cart.php" title="Cart"><i class="fa fa-fw fa-shopping-cart"></i><?php $items_in_cart = is_array($cart) ? count($cart) : 0; echo $items_in_cart?> </a></li>
            </ul>
        </nav>
    </header>

    <main >
        <div id='index-container'>
            <h1 id='index-title'>Welcome to our E-Shop!</h1>

            <a href="allProducts.php">
                <div id='index-image'>
                    <img class="logo" src="images/ty.png" alt='Logo'>
                    <div id="text-bot-center">Check our products</div>
                </div>
            </a>
        </div>
    </main>

    <footer>
        <div class="footer">
            <nav>
                <ul id="footer-nav-ul">
                    <li class="footer-nav-li"><a href="index.php" title="Home">Home</i></a></li>
                    <li class="footer-nav-li"><a href="allProducts.php" title="Products">Products</a></li>
                    <li class="footer-nav-li"><a href="cart.php" title="Cart">Cart</a></li>
                    <li id="copyrights">© KF Team 2019</li>
                </ul>
            </nav>
        </div>
    </footer>
</div>
</body>
</html>
