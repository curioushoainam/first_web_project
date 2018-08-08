<?php 
require ('./class/Cart.php');
$cart = new Cart();

if(isset($_POST['soluong']))
{
	//echo '<pre>',print_r($_POST),'</pre>';
	if($cart->updatetocart($_POST['soluong']))
		echo 'ok';
	else echo 'loi';
}
?>

<div style="margin: 30px 30px; ">
	<h3><a href="?view=order_create">Gian hàng</a> >> Chi tiết giỏ hàng</h3><hr>
	<form action="" method="post" >
		<table width="780px" style="border-collapse:collapse; " border="1" cellspacing="0" cellpadding="5" align="center">
		  <tr>
		    <th>Sản phẩm</th>
		    <th>Số lượng</th>
		    <th>Giá</th>
		    <th>Thành tiền</th>
		    <th><button type="submit" class="btn btn-success">Cập nhật</button></th>
		  </tr>
		  <?php
		  $tong= 0; 
		  foreach($_SESSION['cart'] as $item){
			  $tt = $item['dongia']*$item['soluong'];
			  $tong+=$tt;
		  ?>
		  <tr>
		  	<td style="width: 40%"><img src="./images/products/<?=$item['hinh'] ?>"  width="70"/><br><?=$item['ten']?></td>
		    <td style="width: 10%"><input name="soluong[<?=$item['ma']?>]" value="<?=$item['soluong']?>" style="text-align: center; border: transparent;"/></td>
		    <td  align="right" ><?=number_format($item['dongia'])?></td>
		    <td  align="right" ><?=number_format($tt)?></td>
		    <td style="width: 10%; "><a href="?view=order_deltocart&id=<?=$item['ma']?>">Xóa</a></td>
		  </tr>
		  <?php 
		  }
		  ?>
		   <tr>
		    <td colspan="4" style="text-align: right"><b><?=number_format($tong)?></b></td>
		    <td>&nbsp;</td>
		  </tr>
		</table>
	</form>
	<hr>
	<div align="center">
		<a href="?view=order_create"><b>Mua tiếp</b></a> || <a href="#"><b>Thanh toán</b></a>
	</div>
	 
</div>