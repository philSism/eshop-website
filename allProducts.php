<?php
    require_once 'db_functions.php';
    require_once 'connect.php';
    session_start();
    if(isset($_GET['id'])){
        $_SESSION['id']=$_GET['id'];
    }
    if(isset($_SESSION["cart"])){
        $cart= $_SESSION["cart"];
    }else{
        $cart=null;
    }
    $checkedRadio0='';
    $checkedRadio10='';
    $checkedRadio20='';
    $checkedRadio21='';
    if(isset($_GET['price'])){
        if($_GET['price']==0){
            $checkedRadio0=' checked="checked"';
        }else if($_GET['price']==10){
            $checkedRadio10=' checked="checked"';
        }else if($_GET['price']==20){
            $checkedRadio20=' checked="checked"';
        }else{
            $checkedRadio21=' checked="checked"';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    	<meta charset="utf-8">
    	<title>All Products - E-Shop</title>
	<meta name="keywords" content="eshop, dolls, ty">
	<meta name="description" content="The page where all the products are displayed and can be filtered based on price.">
	<meta name="author" content="Konstantina Gkritsa, Filotas Sismanis">
	<link rel="icon" type="image/ico" href="images/favicon.ico">
   	<link rel="stylesheet" type="text/css" href="backgroundStyle.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="ajax.js"></script>
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

    <main id="main">
        <aside>
            <h1 id="filter-title">Price filter</h1>
            <form name="filters" onsubmit="showUser(this.value)" method="GET">
                <label class="radio-container">All
                    <input  type="radio" name="price" value="0" <?php echo $checkedRadio0;?> >
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">Up to 10€
                    <input  type="radio" name="price" value="10" <?php echo $checkedRadio10;?> >
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">10 - 20€
                    <input  type="radio" name="price" value="20" <?php echo $checkedRadio20;?> >
                    <span class="checkmark"></span>
                </label>
                <label class="radio-container">More than 20€
                    <input  type="radio" name="price" value="21" <?php echo $checkedRadio21;?> >
                    <span class="checkmark"></span>
                </label>
                <input id="filter-submit" type="submit" value="Submit">
            </form>
        </aside>
        <div id="all-products-paddings">
            <?php
            getProducts($link);
            ?>
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
