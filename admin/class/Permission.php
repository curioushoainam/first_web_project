<?php 
class Permission extends Database{

	function readUserList(){
		$sql = 'SELECT * FROM admin WHERE trang_thai=1';
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function readUserInfo($userid){
		$sql = 'SELECT * FROM admin WHERE trang_thai=1 AND ma=?';
		$this->setQuery($sql);
		return $this->loadRow(array($userid));
	}

	function readFuncOfFather($ma_cha = 0){
		$sql = 'SELECT * FROM admin_function WHERE trang_thai=1 AND ma_cha=?';
		$this->setQuery($sql);
		return $this->loadRows(array($ma_cha));
	}

	function revoke($userid){
		$sql = 'delete from admin_permission where ma_quan_tri=?';
		$this->setQuery($sql);
		return $this->execute(array($userid));
	}

	function grantUser($functionid,$userid){
		$sql = 'INSERT INTO `admin_permission` (`ma_chuc_nang`, `ma_nhom`, `trang_thai`, `ma_quan_tri`, `ngay_tao`) VALUES (?, 0, 1, ?, ?)';
		$this->setQuery($sql);
		return $this->execute(array($functionid,$userid,date('y-m-d H:i:s')));
	}

	function grantGroup($groupid,$userid){
		$sql = 'INSERT INTO `admin_permission` (`ma_chuc_nang`, `ma_nhom`, `trang_thai`, `ma_quan_tri`, `ngay_tao`) VALUES (?, 1, 1, ?, ?)';
		$this->setQuery($sql);
		return $this->execute(array($functionid,$userid,date('y-m-d H:i:s')));
	}

	function readFuncOfUser($userid){
		$sql = 'SELECT * FROM `admin_permission` WHERE trang_thai=1 AND ma_quan_tri=?';
		$this->setQuery($sql);
		return $this->loadRows(array($userid));
	}

	function listGranted(){
		$sql = 'SELECT DISTINCT ma_quan_tri, ngay_tao FROM `admin_permission` WHERE trang_thai=1 ORDER BY ma_quan_tri ASC';
		$this->setQuery($sql);
		return $this->loadRows();
	}

	function readLinkOfUser($userid){
		$sql = 'SELECT adp.ma_quan_tri, adp.ma_chuc_nang, adf.link, adf.ten FROM `admin_permission` adp JOIN admin_function adf WHERE adp.ma_chuc_nang = adf.ma AND adp.ma_quan_tri = ?';
		$this->setQuery($sql);
		return $this->loadRows(array($userid));
	}

}

?>