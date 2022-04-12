<?php
$link = @mysqli_connect("webpagesdb.it.auth.gr","konstantina","1234kK");

if (!$link) {
    echo '<p>Error connecting to the database <br>';
    echo 'Please try again.</p>';
    exit();
}


$result = @mysqli_select_db($link, 'gkritsak_');

if (!$result) {
    echo '<p>Error selecting database table <br>';
    echo 'Please try again.</p>';
    exit();
}
?>
