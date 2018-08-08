<?php 
require ('./class/Cart.php');
$dt = new Cart();
if($dt->addtocart($_GET['id'])){
	//báo thêm thành công và chuyển trang
	chuyentrang('?view=order_cart');
} else {
	chuyentrang('?view=order_create');
}

?>
