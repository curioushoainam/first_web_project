<?php 
class Menu extends database {
	private $table = 'menu';

	function loadAll(){
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE trang_thai != 2' ;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function loadOne($ma){
		$sql = 'SELECT * FROM `'.$this->table.'` WHERE `ma`=?' ;
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function add($input = array()){
		$sql = 'INSERT INTO `menu` (`ten`, `link`, `action`, `ma_cha`, `trang_thai`, `ngay_tao`, `ngay_cap_nhat`) VALUES (:ten, :link, :action, :ma_cha, :trang_thai, NOW(), NULL);';
		$this->setQuery($sql);
		return $this->execute($input);
	}

	function update($input = array()){
		$sql = 'UPDATE `'.$this->table.'` SET `ten` = :ten, `link` = :link, `action` = :action, `ma_cha` =:ma_cha ,`trang_thai` = :trang_thai, `ngay_cap_nhat` = NOW(), `alias`=:alias WHERE `'.$this->table.'`.`ma` = :ma';
		$this->setQuery($sql);
		return $this->execute($input);
	}
}

?>