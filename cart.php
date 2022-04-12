<?php
    require_once 'db_functions.php';
    require_once 'connect.php';
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
    <title>Cart - E-Shop</title>
	<meta name="keywords" content="eshop, dolls, ty">
	<meta name="description" content="The shopping cart page of the E-Shop.">
	<meta name="author" content="Konstantina Gkritsa, Filotas Sismanis">
    <link rel="stylesheet" type="text/css" href="backgroundStyle.css">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['delete'])) {
    $del = $_GET['delete'];
    $cart = array();

    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($i == $del)
            continue;
        else
            $cart[] = $_SESSION['cart'][$i];
    }
    $_SESSION['cart'] = $cart;
}
?>

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

        <main>
            <?php
            getProductsForCart($link);
            ?>
            <div class="order">
                <a class="button_order" href="buy.php">BUY</a>
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
