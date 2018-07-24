<?php	
class Products extends Database {	
	var $table = "san_pham";

	function list_products(){		
		$sql = 'SELECT * FROM `' . $this->table .'`';
		$this->setQuery($sql);
		return $this->loadRows();
	}
	
	
	
	
}


?>