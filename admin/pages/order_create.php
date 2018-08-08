<?php
require ('./class/Cart.php');
$cart = new Cart();
$ds = $cart->loadproducts();
?>

<div style="position:relative"><a href="?view=order_cart"><img src="images/cart.png" width="40" /><span style="position:absolute;color:red;font-weight:bold;font-size:30px"><?=$cart->countcart();?></span></a></div>
<div style="overflow:hidden">

<?php 
foreach ($ds as $item){
	$ma = isset($item->ma) ? $item->ma : '';
	$ten = isset($item->ten) ? $item->ten : '';
	$hinhs = isset($item->hinh) ? $item->hinh : '';
	$dongia = isset($item->don_gia) ? $item->don_gia : '';
	$soluong = isset($item->so_luong) ? $item->so_luong : '';
	$giamgia = isset($item->giam_gia) ? $item->giam_gia : '';
?>
	<div style="float:left;margin-right:15px;margin-bottom:15px;    line-height: 26px;
border:1px solid; border-radius:5px;padding:5px;width:160px;min-height:300px">
		<img src="./images/products/<?=explode("|",$hinhs)[0] ?>" width="150" height="120"/>
        <div><?=$ten?></div>
        <div style="color:red"><?=number_format($dongia)?></div>
        <a href="?view=order_addtocart&id=<?=$ma?>" style="border:1px solid;text-decoration:none;padding:4px 3px">Mua</a>
	</div>
<?php
}
?>

