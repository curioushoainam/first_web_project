<?php
class Process_account extends Database {
	private $table = 'quan_tri';
	
	function login($account, $password){
		$sql = 'SELECT * FROM 	`'. $this->table .'` WHERE ten_dang_nhap=? AND mat_khau=?';	
		$this->setQuery($sql);	
		return $this->loadaRow(array($account, $password));
	}
	
	function list_active_accounts($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'` WHERE trang_thai = 1' .$limit;				
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function list_all_accounts($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'`' .$limit;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function list_hidden_accounts($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'` WHERE trang_thai = 0' .$limit;
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function list_deleted_accounts($start = 0, $qty = 0){
		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start,$qty";
		}
		$sql = 'SELECT * FROM `' . $this->table .'` WHERE trang_thai = 2' .$limit;
		$this->setQuery($sql);
		return $this->loadRows();
	}
	function total_accounts($status = ''){
		if ($status == 'all'){
			$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'`';
		}
		else if ($status == 'hidden') {
			$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'` WHERE trang_thai = 0';
		}
		else if ($status == 'deleted') {
			$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'` WHERE trang_thai = 2';
		}		
		else {
			$sql = 'SELECT COUNT(ma) AS total FROM `' . $this->table .'` WHERE trang_thai = 1';
		}
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}

	function getAccountInfo($ma){
		$sql = 'SELECT * FROM `' . $this->table .'` WHERE ma = ?';
		$this->setQuery($sql);
		return $this->loadRow(array($ma));
	}

	function hide_account($ma){
		$sql = 'UPDATE `' . $this->table .'` SET trang_thai = 0 WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($ma);
	}

	function delete_account($ma){
		$sql = 'UPDATE `' . $this->table .'` SET trang_thai = 2 WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($ma);
	}

	// Hàm kiểm tra sự tồn tại của account
	// Nếu tồn tại, trả về true; ngược lại là false
	function isAccount($account){
		$sql = 'SELECT ma FROM `' . $this->table .'` WHERE ten_dang_nhap = ?';
		$this->setQuery($sql);
		if ($this->loadRow(array($account)))
			return true;
		else
			return false;
	}

	// Hàm kiểm tra sự tồn tại của email
	// Nếu tồn tại, trả về true; ngược lại là false
	function isEmail($email){
		$sql = 'SELECT * FROM `' . $this->table .'` WHERE email = ?';
		$this->setQuery($sql);
		if ($this->loadRow(array($email)))
			return true;
		else
			return false;		
	}

	function addAccount($newAccount = array()){
		$sql = 'INSERT INTO `'. $this->table .'`(ten_dang_nhap, email, mat_khau, ho_ten, dia_chi, ma_nhom, trang_thai, ngay_tao) VALUES (?,?,?,?,?,?,?,?)';
		$this->setQuery($sql);
		return $this->execute($newAccount);
	}

	// Hàm trả về giá trị mật khẩu của mã tương ứng
	function getPassword($username){
		$sql = 'SELECT mat_khau FROM `' . $this->table .'` WHERE ten_dang_nhap = ?';
		$this->setQuery($sql);
		return $this->loadRow(array($username));
	}

	function updateAccount($param = array()){
		$sql = 'UPDATE `' . $this->table .'` SET email = ?, ho_ten = ?, dia_chi = ?, ma_nhom = ?, trang_thai = ?, ngay_cap_nhat = ? WHERE ma = ?';
		$this->setQuery($sql);
		return $this->execute($param);
	}

	function getColumnInfo($column_name){
		$sql = 'SELECT DISTINCT `?` FROM ' . $this->table;
		$this->setQuery($sql);
		return $this->loadRows(array($column_name));
	}

	function getIDofEmail($email){
		$sql = 'SELECT ma FROM `' . $this->table . '` WHERE email = ?';		
		$this->setQuery($sql);
		return $this->loadRows(array($email));
	}
}

?>