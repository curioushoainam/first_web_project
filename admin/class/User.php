<?php 
class User extends Database {

	function loadNewOrders(){
		$sql = 'SELECT ma,account,amount,createdDate FROM `invoice` WHERE `status`=1';
		$this->setquery($sql);
		return $this->loadrows();
	}


	function loadUsers(){
		$sql = 'SELECT * FROM `user`';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function loadActiveUsers(){
		$sql = 'SELECT * FROM `user` WHERE trang_thai=1';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function loadHiddenUsers(){
		$sql = 'SELECT * FROM `user` WHERE trang_thai=0';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function loadDeletedUsers(){
		$sql = 'SELECT * FROM `user` WHERE trang_thai=2';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function loadNewUsers(){
		$sql = 'SELECT * FROM `user` WHERE xac_thuc!=1';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function approveUser($ma,$res){
		$sql = 'UPDATE `user` SET `xac_thuc`=1, `trang_thai`=? WHERE ma=?';
		$this->setquery($sql);
		return $this->execute(array($res, $ma));
	}

	function loadCmts(){
		$sql = 'SELECT * FROM `comments`';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function loadNewCmts(){
		$sql = 'SELECT * FROM `comments` WHERE isNew=1';
		$this->setquery($sql);
		return $this->loadrows();
	}

	function approveCmt($ma,$res){
		$sql = 'UPDATE `comments` SET `isNew`=0, `ngay_duyet`=NOW(), `isAccept`=? WHERE ma=?';
		$this->setquery($sql);
		return $this->execute(array($res, $ma));
	}
}

?>