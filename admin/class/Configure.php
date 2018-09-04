<?php
class Configure extends Database {
	private $table = 'config';
	
	function getSMTPConfig(){
		$sql = 'SELECT `gia_tri`  FROM 	`'. $this->table .'` WHERE khoa = "smtp"';	
		$this->setQuery($sql);	
		return $this->loadRow();
	}

	// function updateSMTPConfig($param = array()){
	// 	$sql = 'UPDATE `' . $this->table .'` SET mail_from=?, from_name=?, smtp_auth=?, smtp_host=?, smtp_user=?, smtp_pass=?, smtp_secure=?, smtp_port=? WHERE ma = 1';
	// 	$this->setQuery($sql);
	// 	return $this->execute($param);
	// }
	
}

?>