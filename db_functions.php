<?php



function displayImage($link){

    $query='SELECT image FROM product WHERE idproduct='.$_SESSION['id'];
    $results = @mysqli_query($link, $query);
    if($results->num_rows>0){
        while ($row=$results->fetch_assoc()){
            $image="images/".$row["image"];
            print"<img src=\"$image\" width=\"200px\" height=\"200px\"\/>";
        }
    }
}

function displayPrice($link){

    $query='SELECT price FROM product WHERE idproduct='.$_SESSION['id'];
    $results = @mysqli_query($link, $query);
    if($results->num_rows>0){
        while ($row=$results->fetch_assoc()){
            $price=$row["price"];
            print "<p>Price: ".$price."</p>";
        }
    }
}


function displayRating( $link){

    $query='SELECT rating FROM product WHERE idproduct='.$_SESSION['id'];
    $results = @mysqli_query($link, $query);
    if($results->num_rows>0){
        while ($row=$results->fetch_assoc()){
            $r=$row["rating"];
            print "<p>Rating: ".number_format($r,2).'<span class="fa fa-star checked"></span></p>';
        }
    }
}



function displayTitle($link){

    $query='SELECT title FROM product WHERE idproduct='.$_SESSION['id'];
    $results = @mysqli_query($link, $query);
    if($results->num_rows>0){
        while ($row=$results->fetch_assoc()){
            $title=$row["title"];
            print "<h3>".$title."</h3>";
        }
    }

}



//saving the comments to the database
function setComment($connection,$id){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitButt'])){
        if($_POST['username']!=""){
            $username = $_POST['username'];
            //$umail_safe = mysqli_real_escape_string($umail);
        } else {
            $username = 'User';
        }

        $currentRating=0;
        $totalReviews=0;

        $query='SELECT rating FROM review WHERE product_id='.$id;
        $results = @mysqli_query($connection, $query);
        if($results->num_rows>0){
            while ($row=$results->fetch_assoc()){
                $currentRating=$currentRating+$row["rating"];
                $totalReviews++;
            }
        }
        print $currentRating;

        $text = $_POST['message'];
        $user = addslashes($username);
        $t = addslashes($text);
        $r = $_POST['rating'];

        $u=mysqli_real_escape_string($connection,$user);
        $safeText=mysqli_real_escape_string($connection,$t);

        $totalReviews++;
        $updatedRating=($currentRating+$r)/$totalReviews;
        $sql = 'UPDATE product SET rating='.$updatedRating.' WHERE idproduct='.$id;
        $connection->query($sql);


        $sql = "INSERT INTO review(user, comment,rating,product_id) VALUES('$u', '$safeText',$r,$id)";
        $result = @mysqli_query($connection,$sql);
    }
}

function getProductsForCart($link){

    $total = 0;
    echo '<table id="customers" align="center">';


    echo '<div class="header"';
    echo '<tr>';
    echo '<th>Title</th>';
    echo '<th>Price</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</div';
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        $query = "select * from product WHERE idproduct=".$_SESSION['cart'][$i];
        $result = @mysqli_query($link,$query);
        echo '<tr>';
        if($row=$result->fetch_assoc()){
            echo "<td>" .$row["title"]. "</td>";
            echo "<td>" .$row["price"]. "</td>";
            $total = $total + $row['price'];
        }
        echo '<td><a href="cart.php?delete=' . $i . '">' . 'Remove' . '</a></td>';
        echo '</tr>';


    }
    echo "<tr><td>Total</td><td>$total</td><td></td></tr>";
    echo '</table>';
}


function getComment($connection,$id){
    $sql = 'SELECT * FROM review WHERE product_id='.$id;
    $query = @mysqli_query($connection,$sql);

    if($query->num_rows>0) {
        while ($row = mysqli_fetch_array($query)) {
            echo "<div class='left-float'>";
            $image = "images/no-user.jpg";
            print"<img src=\"$image\" width=\"50px\" height=\"50px\"\/>";
            echo "<p>" . htmlspecialchars($row['user']) . "</p>";
            echo "</div>";
            echo "<div class='dialogbox'>";
            echo "<div class='body'>";
            echo "<span class='tip tip-left'></span>";
            echo "<div class='message'>";
            echo "<p>" . htmlspecialchars($row['comment']) . " </p>";
            echo "<p> " . $row['rating'] . "<span class=\"fa fa-star checked\"></span> </p>";
            echo "</br>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }

}

function getProducts($link){


    //set page for pagination
    $limit = 8;
    $price = 0;
    if(!isset($_GET['page'])){
        $page = 1;
    } else {
        $page=$_GET['page'];
    }

    $start = ($page-1) * $limit;


    //selection of products based on filter
    if (isset($_GET['price'])) {
        $price = intval($_GET['price']);

        if( $price == 10) {
            $filter_title = "Up to 10€";
            $sql = "SELECT * FROM product WHERE price <= 10";
            $result = $link->query($sql);
            $number_of_products = $result->num_rows;
            $number_of_pages = ceil($number_of_products / $limit);
            $sql = "SELECT * FROM product WHERE price <= 10 ORDER BY idproduct DESC LIMIT ".$start.','. $limit;
            $result = $link->query($sql);
        } elseif ( $price == 20) {
            $filter_title = "From 10€ to 20€";
            $sql = "SELECT * FROM product WHERE price >= 10 && price <= 20";
            $result = $link->query($sql);
            $number_of_products = $result->num_rows;
            $number_of_pages = ceil($number_of_products / $limit);
            $sql = "SELECT * FROM product WHERE price >= 10 && price <= 20 ORDER BY idproduct DESC LIMIT ".$start.','. $limit;
            $result = $link->query($sql);
        } elseif ( $price == 21) {
            $filter_title = "More than 20€";
            $sql = "SELECT * FROM product WHERE price > 20";
            $result = $link->query($sql);
            $number_of_products = $result->num_rows;
            $number_of_pages = ceil($number_of_products / $limit);
            $sql = "SELECT * FROM product WHERE price > 20 ORDER BY idproduct DESC LIMIT ".$start.','. $limit;
            $result = $link->query($sql);
        } else {

            $filter_title = "All";
            $sql = "SELECT * FROM product";
            $result = $link->query($sql);
            $number_of_products = $result->num_rows;
            $number_of_pages = ceil($number_of_products / $limit);
            $sql = "SELECT * FROM product ORDER BY idproduct DESC LIMIT ".$start.','. $limit;
            $result = $link->query($sql);
        }
    } else {
        $filter_title = "All";
        $sql = "SELECT * FROM product";
        $result = $link->query($sql);
        $number_of_products = $result->num_rows;
        $number_of_pages = ceil($number_of_products / $limit);
        $sql = "SELECT * FROM product ORDER BY idproduct DESC LIMIT ".$start.','. $limit;
        $result = $link->query($sql);
    }

    //product display
    if ($number_of_products > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class=product-wrapper>";
            $url="product.php?id=".$row["idproduct"];
            echo "<a class=polaroid href='$url'>";
            $image="images/".$row["image"];
            echo "<img class=product-img src=\"$image\" width=\"200px\" height=\"200px\"\/>";
            echo "<div class=polaroid-container>";
            echo $row["title"]."<br>";
            echo number_format($row["rating"],2)." <span class='fa fa-star star'></span>"."<br>";
            echo $row["price"]."€";
            echo "</div>";
            echo "</a>";
            echo "</div>";
        }
    } else {
        echo "<div id=no-results>";
        echo "0 results";
        echo "</div>";
    }

    //pagination
    echo '<div class = pagination>';
    for ($current_page = 1; $current_page<=$number_of_pages; $current_page++){
        if($page==$current_page) {
            echo '<a href= "allProducts.php?price='. $price .'&page=' . $current_page . ' " class=active>' . $current_page . '</a> ';
        } else {
            echo '<a href= "allProducts.php?price='. $price .'&page=' . $current_page . ' ">' . $current_page . '</a> ';
        }
    }
    echo '</div>';


}

?>
