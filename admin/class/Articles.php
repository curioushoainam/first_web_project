<?php 
class Articles extends Database {
	private $table = 'articles';

	function get_articles($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'`' .$limit;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function get_article($ma){		
		$sql = 'SELECT * FROM `' . $this->table .'` ' .'WHERE ma=?';
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function total_articles(){
		$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'`';
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}

	function add_article($newArticleGroup = array()){
		$sql = 'INSERT INTO `'. $this->table .'`(alias,ten,tieu_de,mo_ta,tu_khoa,hinh,hinh_chia_se,tom_tat,chi_tiet,ma_nhom_tin,trang_thai,ngay_tao,ngay_cap_nhat) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
		$this->setQuery($sql);
		return $this->execute($newArticleGroup);
	}

	function update_article($param = array()){
		$sql = 'UPDATE `' . $this->table .'` SET ten= ?, ma_cha= ?, alias= ?, tieu_de= ?, tu_khoa= ?, mo_ta= ?, hinh_chia_se= ?, trang_thai= ?, ngay_cap_nhat= ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($param);
	}	

	function delete_article($date, $ma){
		$sql = 'UPDATE `' . $this->table .'` SET trang_thai = 2, ngay_cap_nhat = ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute(array($date, $ma));
	}	
}

?>