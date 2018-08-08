<?php 
//echo $_GET['id'];
require ('./class/Cart.php');
$cart = new Cart();

$cart->deltocart($_GET['id']);
chuyentrang('?view=order_cart');
?>