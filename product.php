<?php
    require_once 'db_functions.php';
    require_once 'connect.php';
    session_start();
    if(isset($_GET['id'])){
        $_SESSION['id']=$_GET['id'];

    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitButt'])){
        header("Location: product.php");
        header("HTTP/1.1 303 See Other");
    }
    $id=$_SESSION['id'];
    if (isset($_GET["productid"])) {
        $_SESSION["cart"][] = $_GET["productid"];
        $cart= $_SESSION["cart"];
        header("Location: product.php");
        header("HTTP/1.1 303 See Other");
    }else{
        $cart=null;
    }

    if(isset($_SESSION["cart"])){
        $cart= $_SESSION["cart"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product Page - E-Shop</title>
	<meta name="keywords" content="eshop, dolls, ty">
	<meta name="description" content="The page where a chosen product is displayed with details and comments about it.">
	<meta name="author" content="Konstantina Gkritsa, Filotas Sismanis">
	<link rel="icon" type="image/ico" href="images/favicon.ico">
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

    <main>

            <figure class="left-float">
                <?php displayImage($link); ?>
            </figure>
            <?php  displayTitle($link);?>
            <?php displayPrice($link);?>
            <p id="box-rating">

            </p>
        <?php displayRating($link);?>

        <?php
            $url=$_SERVER['PHP_SELF'] . "?productid=" . $id;
            echo "<a href='$url'><i class=\"fa fa-shopping-cart\"></i></a>";
        ?>


           <div class="box">
               <h3>Comments</h3>
               <form id="comment-form" action="<?php setComment($link,$id);?>" method="POST">
                   <p><label>Username: <input type='username' name='username' maxlength="10" id='username' placeholder='optional' >
                   <select id="rating" name="rating">
                       <option value="1">1<span class="fa fa-star checked"></option>
                       <option value="2">2<span class="fa fa-star checked"></option>
                       <option value="3">3<span class="fa fa-star checked"></option>
                       <option value="4">4<span class="fa fa-star checked"></option>
                       <option value="5">5<span class="fa fa-star checked"></option>
                   </select>
                   <p><label>Comment: <textarea name='message' maxlength="100" id='message' required='required' placeholder='Write your comment here'></textarea>
                   <button id='submitButt' name='submitButt' type='submit'>Comment</button>
               </form>
           </div>




            <div class="container">
                <?php
                    getComment($link,$id);
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
