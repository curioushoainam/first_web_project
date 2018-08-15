<?php 
class Slider extends database {
	function ma_sp(){
		$sql = 'SELECT DISTINCT `ma` AS ma_sp FROM `products` ORDER BY `ma` DESC';
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function ten_sp($ma){
		$sql = 'SELECT ten FROM `products` WHERE ma = ?';
		$this->setQuery($sql);
		return $this->loadRow(array($ma))->ten;
	}

	function loadSliders(){
		$sql = 'SELECT * FROM `media_slider` WHERE trang_thai=1' ;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function loadSlider($ma){
		$sql = 'SELECT * FROM `media_slider` WHERE `ma`=?' ;
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function addSlider($input = array()){
		$sql = 'INSERT INTO `media_slider` (`ma_sp`, `ten_sp`, `hinh`, `title`, `prim`, `subtitle`, `trang_thai`, `ngay_tao`, `ngay_cap_nhat`) VALUES (:ma_sp, :ten_sp, :hinh, :trang_thai, NOW() , NULL)';
		$this->setQuery($sql);
		return $this->execute($input);
	}

	function updateSlider($input = array()){
		$sql = 'UPDATE `media_slider` SET `ma_sp` = :ma_sp, `ten_sp` = :ten_sp, `hinh` = :hinh, `title`=:title, `prim`=:prim, `subtitle`=:subtitle, `trang_thai` =:trang_thai, `ngay_cap_nhat`= NOW() WHERE `media_slider`.`ma` = :ma';
		$this->setQuery($sql);
		return $this->execute($input);
	}
}

?>