<?php 
class Article_group extends Database {
	private $table = 'article_group';

	function get_article_groups($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'`' .$limit;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function get_article_group($ma){		
		$sql = 'SELECT * FROM `' . $this->table .'` ' .'WHERE ma=?';
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function total_article_groups(){
		$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'`';
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}

	function add_article_group($newArticleGroup = array()){
		$sql = 'INSERT INTO `'. $this->table .'`(ten, ma_cha, alias, tieu_de, tu_khoa, mo_ta, hinh_chia_se, trang_thai, ngay_tao, ngay_cap_nhat) VALUES (?,?,?,?,?,?,?,?,?,?)';
		$this->setQuery($sql);
		return $this->execute($newArticleGroup);
	}

	function update_article_group($param = array()){
		$sql = 'UPDATE `' . $this->table .'` SET ten= ?, ma_cha= ?, alias= ?, tieu_de= ?, tu_khoa= ?, mo_ta= ?, hinh_chia_se= ?, trang_thai= ?, ngay_cap_nhat= ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($param);
	}
	function update_article_group_woimg($param = array()){
		$sql = 'UPDATE `' . $this->table .'` SET ten= ?, ma_cha= ?, alias= ?, tieu_de= ?, tu_khoa= ?, mo_ta= ?, trang_thai= ?, ngay_tao= ?, ngay_cap_nhat= ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($param);
	}

	function delete_article_group($date, $ma){
		$sql = 'UPDATE `' . $this->table .'` SET trang_thai = 2, ngay_cap_nhat = ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute(array($date, $ma));
	}

}

?>