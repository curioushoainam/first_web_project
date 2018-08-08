<?php
class DatabaseFuncs extends Database{

	// $table : bảng cơ sở dữ liệu
	// $string : là mảng dạng 'columnName' => value;
	// Hàm trả về true nếu thành công; ngược lại là false
	function create($table, $string=array()){
		if(!is_array($string)) return false;
		$beVal = '(';
		$afVal = '(';
		$assign = array();
		foreach($string as $key => $val){
			$beVal .= $key . ',';
			$afVal .= ':'.$key.',';
			$assign[':'.$key] = $val;
		}
		$beVal = rtrim($beVal, ",") .')';
		$afVal = rtrim($afVal, ",") .')';
		$sql = 'INSERT INTO `'. $table .'` '. $beVal .' VALUES '. $afVal;
		$this->setQuery($sql);
		return $this->execute($assign);
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $columns : mảng các cột cần lấy dữ liệu ra dạng array(col1, col2, ...)
	// $condition : là mảng điều kiện dạng 'columnName' => value
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC	
	// $start = 0, $qty = 0 : dùng cho LIMIT	
	// Hàm trả về dữ liệu dạng đối tượng đã được lọc theo điều kiện '='
	function read($table, $columns = array(), $condition=array(), $order = array(), $start = 0, $qty = 0){
		if(!is_array($condition)) return false;	
		if(!is_array($columns)) return false;

		$cols = '';
		foreach($columns as $col){
			$cols .= $col.', ';
		}
		$cols = rtrim(trim($cols), ",");

		$afWh = '';
		$assign = array();
		if($condition){	
			foreach($condition as $key => $val){
				$afWh .= $key . ' = :'.$key .' ';			
				$assign[':'.$key] = $val;	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start, $qty";
		}
		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT '.$cols.' FROM `'. $table .'` WHERE '.$afWh.' '.$orderby.' '.$limit;
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		//viewArr($assign);	
		$this->setQuery($sql);
		return $this->loadRows($assign);		
	}

	// $table : bảng cơ sở dữ liệu
	// $columns : mảng các cột cần lấy dữ liệu ra dạng array(col1, col2, ...)
	// $condition : là mảng điều kiện dạng 'columnName' => value
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC	
	// $start = 0, $qty = 0 : dùng cho LIMIT	
	// Hàm trả về dữ liệu dạng đối tượng đã được lọc theo điều kiện '='
	function readarow($table, $columns = array(), $condition=array()){
		if(!is_array($condition)) return false;	
		if(!is_array($columns)) return false;

		$cols = '';
		foreach($columns as $col){
			$cols .= $col.', ';
		}
		$cols = rtrim(trim($cols), ",");

		$afWh = '';
		$assign = array();
		if($condition){	
			foreach($condition as $key => $val){
				$afWh .= $key . ' = :'.$key .' ';			
				$assign[':'.$key] = $val;	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$sql = 'SELECT '.$cols.' FROM `'. $table .'` WHERE '.$afWh;
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		//viewArr($assign);	
		$this->setQuery($sql);
		return $this->loadRow($assign);		
	}

	// $table : bảng cơ sở dữ liệu
	// $string : là mảng dạng 'columnName' => value;
	// $condition : là mảng điều kiện dạng 'columnName' => value
	// Hàm trả về true nếu thành công; ngược lại là false theo điều kiện '='
	function update($table, $string=array(), $condition=array()){
		if(!is_array($string)) return false;
		if(!is_array($condition)) return false;

		$afSet = '';
		$afWh = '';
		$assign = array();
		foreach($string as $key => $val){
			$afSet .= $key . ' = :'.$key .', ';			
			$assign[':'.$key] = $val;
		}
		$afSet = rtrim(trim($afSet), ",");

		foreach($condition as $key => $val){
			$afWh .= $key . ' = :'.$key .' ';			
			$assign[':'.$key] = $val;	
		}
		$afWh = trim($afWh);

		$sql = 'UPDATE `'. $table .'` SET '. $afSet .' WHERE '. $afWh;
		$this->setQuery($sql);
		return $this->execute($assign);
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}
	
	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng điều kiện dạng 'columnName' => value
	// Hàm có chức năng Xoá một dòng khỏi database
	// Hàm trả về true nếu thành công; ngược lại là false theo điều kiện '='
	function delete($table, $condition=array()){
		if(!is_array($condition)) return false;		
		
		$afWh = '';
		$assign = array();		
		foreach($condition as $key => $val){
			$afWh .= $key . ' = :'.$key .' ';			
			$assign[':'.$key] = $val;	
		}
		$afWh = trim($afWh);

		$sql = 'DELETE FROM `'. $table .'` WHERE '. $afWh;
		$this->setQuery($sql);
		return $this->execute($assign);
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}	

	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng điều kiện dạng 'columnName' => value
	// $column : tên cột dùng để đếm số dòng
	// Hàm trả về giá trị integer là tổng số dòng của cột column theo điều kiện '='
	function totalRows($table, $column, $condition = array()){
		$afWh = '';
		$assign = array();
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' = :'.$key .', ';			
				$assign[':'.$key] = $val;	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$sql = 'SELECT COUNT('.$column.') AS total FROM `'. $table .'` WHERE '. $afWh;
		$this->setQuery($sql);
		return $this->loadRow($assign)->total;
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu	
	// $column : tên cột sẽ được lấy dữ liệu
	// $condition : điều kiện để lọc
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC
	// Hàm trả về đối tượng mảng chứa các giá trị không trùng lặp trong cột column theo điều kiện '='
	function getColInfo($table, $column_name, $condition = array(), $order = array()){
		$afWh = '';
		$assign = array();
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' = :'.$key .' ';			
				$assign[':'.$key] = $val;	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT DISTINCT '.$column_name.' FROM `' . $table.'` WHERE '. $afWh.' '.$orderby;
		$this->setQuery($sql);
		return $this->loadRows($assign);		
		// viewArr($assign);		
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $columns : mảng các cột cần lấy dữ liệu ra dạng array(col1, col2, ...)
	// $condition : là mảng có 1 điều kiện dạng 'columnName' => [sign, value]	
	// $start = 0, $qty = 0 : dùng cho LIMIT
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC
	// Hàm trả về dữ liệu dạng đối tượng đã được lọc theo điều kiện
	function read2($table, $columns = array(), $condition=array(), $order = array(), $start = 0, $qty = 0){
		if(!is_array($condition)) return false;	
		if(!is_array($columns)) return false;

		$cols = '';
		foreach($columns as $col){
			$cols .= $col.', ';
		}
		$cols = rtrim(trim($cols), ",");

		$afWh = '';
		$assign = array();
		if($condition){	
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start, $qty";
		}
		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT '.$cols.' FROM `'. $table .'` WHERE '.$afWh.' '.$orderby.' '.$limit;
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		// viewArr($assign);	
		$this->setQuery($sql);
		return $this->loadRows($assign);
	}

	// $table : bảng cơ sở dữ liệu
	// $string : là mảng dạng 'columnName' => value;
	// $condition : là mảng có 1 điều kiện dạng 'columnName' => [sign, value]
	// Hàm trả về true nếu thành công; ngược lại là false
	function update2($table, $string=array(), $condition=array()){
		if(!is_array($string)) return false;
		if(!is_array($condition)) return false;

		$afSet = '';
		$afWh = '';
		$assign = array();
		foreach($string as $key => $val){
			$afSet .= $key . ' = :'.$key .', ';			
			$assign[':'.$key] = $val;
		}
		$afSet = rtrim(trim($afSet), ",");

		foreach($condition as $key => $val){
			$afWh .= $key . ' '.$val[0].' :'.$key .' ';			
			$assign[':'.$key] = $val[1];	
		}
		$afWh = trim($afWh);

		$sql = 'UPDATE `'. $table .'` SET '. $afSet .' WHERE '. $afWh;
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		$this->setQuery($sql);
		return $this->execute($assign);		
	}

	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng có 1 điều kiện dạng 'columnName' => [sign, value]
	// Hàm có chức năng Xoá một dòng khỏi database
	// Hàm trả về true nếu thành công; ngược lại là false theo điều kiện
	function delete2($table, $condition=array()){
		if(!is_array($condition)) return false;		
		
		$afWh = '';
		$assign = array();		
		foreach($condition as $key => $val){
			$afWh .= $key . ' '.$val[0].' :'.$key .' ';			
			$assign[':'.$key] = $val[1];	
		}
		$afWh = trim($afWh);

		$sql = 'DELETE FROM `'. $table .'` WHERE '. $afWh;
		// $this->setQuery($sql);
		// return $this->execute($assign);
		viewArr($assign);
		echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng có 1 điều kiện dạng 'columnName' => [sign, value]
	// $column : tên cột dùng để đếm số dòng
	// Hàm trả về giá trị integer là tổng số dòng của cột column theo điều kiện
	function totalRows2($table, $column, $condition = array()){
		$afWh = '';
		$assign = array();
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$sql = 'SELECT COUNT('.$column.') AS total FROM `'. $table .'` WHERE '. $afWh;
		$this->setQuery($sql);
		return $this->loadRow($assign)->total;
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu	
	// $column : tên cột sẽ được lấy dữ liệu
	// $condition : là mảng có 1 điều kiện dạng 'columnName' => [sign, value]
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC
	// Hàm trả về đối tượng mảng chứa các giá trị không trùng lặp trong cột column theo điều kiện
	function getColInfo2($table, $column_name, $condition = array(), $order = array()){
		$afWh = '';
		$assign = array();		
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);			
		} else
			$afWh = '1';

		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT DISTINCT '.$column_name.' FROM `' . $table.'` WHERE '. $afWh.' '.$orderby;
		$this->setQuery($sql);
		return $this->loadRows($assign);		
		// viewArr($assign);		
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $columns : mảng các cột cần lấy dữ liệu ra dạng array(col1, col2, ...)
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word = ''	
	// $start = 0, $qty = 0 : dùng cho LIMIT
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC
	// Hàm trả về dữ liệu dạng đối tượng đã được lọc theo điều kiện
	function read3($table, $columns = array(), $condition=array(), $order = array(), $start = 0, $qty = 0){
		if(!is_array($condition)) return false;	
		if(!is_array($columns)) return false;

		$cols = '';
		foreach($columns as $col){
			$cols .= $col.', ';
		}
		$cols = rtrim(trim($cols), ",");

		$afWh = '';
		$assign = array();
		if($condition){	
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$limit = '';
		if($qty > 0) {
			$limit = " LIMIT $start, $qty";
		}
		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT '.$cols.' FROM `'. $table .'` WHERE '.$afWh.' '.$orderby.' '.$limit;
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		// viewArr($assign);	
		$this->setQuery($sql);
		return $this->loadRows($assign);
	}

	// $table : bảng cơ sở dữ liệu
	// $string : là mảng dạng 'columnName' => value;
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word
	// Hàm trả về true nếu thành công; ngược lại là false
	function update3($table, $string=array(), $condition=array()){
		if(!is_array($string)) return false;
		if(!is_array($condition)) return false;

		$afSet = '';
		$afWh = '';
		$assign = array();
		foreach($string as $key => $val){
			$afSet .= $key . ' = :'.$key .', ';			
			$assign[':'.$key] = $val;
		}
		$afSet = rtrim(trim($afSet), ",");

		foreach($condition as $key => $val){
			$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
			$assign[':'.$key] = $val[1];	
		}
		$afWh = trim($afWh);

		$sql = 'UPDATE `'. $table .'` SET '. $afSet .' WHERE '. $afWh;
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		$this->setQuery($sql);
		return $this->execute($assign);		
	}

	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word = ''
	// Hàm có chức năng Xoá một dòng khỏi database
	// Hàm trả về true nếu thành công; ngược lại là false theo điều kiện
	function delete3($table, $condition=array()){
		if(!is_array($condition)) return false;		
		
		$afWh = '';
		$assign = array();		
		foreach($condition as $key => $val){
			$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
			$assign[':'.$key] = $val[1];	
		}
		$afWh = trim($afWh);

		$sql = 'DELETE FROM `'. $table .'` WHERE '. $afWh;
		// $this->setQuery($sql);
		// return $this->execute($assign);
		viewArr($assign);
		echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word = ''
	// $column : tên cột dùng để đếm số dòng
	// Hàm trả về giá trị integer là tổng số dòng của cột column theo điều kiện
	function totalRows3($table, $column, $condition = array()){
		$afWh = '';
		$assign = array();
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$sql = 'SELECT COUNT('.$column.') AS total FROM `'. $table .'` WHERE '. $afWh;
		$this->setQuery($sql);
		return $this->loadRow($assign)->total;
		// viewArr($assign);
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu	
	// $column : tên cột sẽ được lấy dữ liệu
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word = ''
	// $order : mảng 1 dòng dạng 'columnNam' => DESC or ASC
	// Hàm trả về đối tượng mảng chứa các giá trị không trùng lặp trong cột column theo điều kiện
	function getColInfo3($table, $column_name, $condition = array(), $order = array()){
		$afWh = '';
		$assign = array();		
		if($condition){
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);			
		} else
			$afWh = '1';

		$orderby = '';
		if($order){
			$orderby .= 'ORDER BY ';
			foreach($order as $key => $val){
				$orderby .= $key.' '.$val.', ';
			}
			$orderby = rtrim(trim($orderby), ",");
		}

		$sql = 'SELECT DISTINCT '.$column_name.' FROM `' . $table.'` WHERE '. $afWh.' '.$orderby;
		$this->setQuery($sql);
		return $this->loadRows($assign);		
		// viewArr($assign);		
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
	}

	// $table : bảng cơ sở dữ liệu
	// $columns : mảng các cột cần lấy dữ liệu ra dạng array(col1, col2, ...)
	// $condition : là mảng có nhiều điều kiện dạng 'columnName' => [sign, value, link_word];
	// link_word là AND, OR, ... với các điều kiện sau => đk sau cùng có link_word = ''	
	// Hàm trả về dữ liệu dạng đối tượng đã được lọc theo điều kiện
	function readarow3($table, $columns = array(), $condition=array()){
		if(!is_array($condition)) return false;	
		if(!is_array($columns)) return false;

		$cols = '';
		foreach($columns as $col){
			$cols .= $col.', ';
		}
		$cols = rtrim(trim($cols), ",");

		$afWh = '';
		$assign = array();
		if($condition){	
			foreach($condition as $key => $val){
				$afWh .= $key . ' '.$val[0].' :'.$key .' '.$val[2].' ';			
				$assign[':'.$key] = $val[1];	
			}
			$afWh = trim($afWh);
		} else
			$afWh = '1';

		$sql = 'SELECT '.$cols.' FROM `'. $table .'` WHERE '.$afWh;
		// echo '<script type="text/javascript">alert("'. $sql .'")</script>';
		// viewArr($assign);	
		$this->setQuery($sql);
		return $this->loadRow($assign);
	}
}

?>


	