<?php 
class Productbrand extends database {
	private $table = 'product_supplier';

	function loadAll(){
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE trang_thai=1' ;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function loadOne($ma){
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE `ma`=?' ;
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function add($input = array()){
		$sql = 'INSERT INTO `'.$this->table.'` (`ten`, `alias`,`hinh`, `trang_thai`, `ngay_tao`, `ngay_cap_nhat`) VALUES (:ten, :alias, :hinh, :trang_thai, NOW(), NULL)';
		$this->setQuery($sql);
		return $this->execute($input);
	}

	function update($input = array()){
		$sql = 'UPDATE `'.$this->table.'` SET `ten` = :ten, `alias` = :alias, `hinh` =:hinh ,`trang_thai` = :trang_thai, `ngay_cap_nhat` = NOW() WHERE `'.$this->table.'`.`ma` = :ma';
		$this->setQuery($sql);
		return $this->execute($input);
	}
}

?>