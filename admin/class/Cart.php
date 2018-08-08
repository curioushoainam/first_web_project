<?php 
class Cart extends DatabaseFuncs {

	function loadproducts(){
		$sql = 'select * from products where trang_thai=1';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function detailproduct($id){
		$sql = 'select * from products where trang_thai=1 and ma=?';
		$this->setquery($sql);
		return $this->loadrow(array($id));
	}

	function setcart(){
		//su dung session de luu hang cua nguoi dung dang mua
		if(!isset($_SESSION['cart']))
			$_SESSION['cart'] = array();
	}	

	function addtocart($product_id){
		if(!$product_id) return false;
		// doc cai san pham voi cai ma dc dua vao de kiem tra du lieu va add vao gio voi thong tin dang co
		$item = $this->detailproduct($product_id);		
		if(!($item && $item->so_luong > 1)) return false;

		//ok co sna pham tien hanh add vao gio
		//tao san  pham tren gio hang de add vao
		$itemadd =  array(
			'ma'=>$item->ma,
			'ten'=>$item->ten,
			'hinh'=>explode("|",$item->hinh)[0],
			'dongia'=>$item->don_gia,
			'soluong'=>1,
			'giamgia'=>$item->giam_gia
		);

		// kiem tra su ton tai cua gio hang
		if (isset($_SESSION['cart'] , $_SESSION['cart'][$item->ma])){
			// tang so luong
			$_SESSION['cart'][$item->ma]['soluong'] += 1;
		} else 
			$_SESSION['cart'][$item->ma]= $itemadd;

		return true;		
	}

	function deltocart($product_id){
		if (!$product_id) return false;
		if(isset($_SESSION['cart'], $_SESSION['cart'][$product_id])){
			unset($_SESSION['cart'][$product_id]);
			return true;
		} else 
			return false;
	}

	function updatetocart($data){
		if (!(isset($data) && $data)) return false;
		foreach ($data as $ma => $soluong){
			$_SESSION['cart'][$ma]['soluong'] = $soluong;			
		}
		return true;
	}

	function countcart(){
		if(isset($_SESSION['cart']) && $_SESSION['cart'])
			return count($_SESSION['cart']);
		else 
			return 0;
	}
}

?>
