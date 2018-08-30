<?php  
class Pagination {
	protected $_config = array(
		'current_page'  => 1, // Trang hiện tại
	    'total_record'  => 1, // Tổng số record
	    'total_page'    => 1, // Tổng số trang
	    'limit'         => 10,// limit
	    'start'         => 0, // start
	    'link_full'     => '#',// Link full có dạng như sau: domain/com/page/{page}
	    'link_first'    => '#',// Link trang đầu tiên
	    'range'         => 9, // Số button trang bạn muốn hiển thị 
        'min'           => 0, // Tham số min
        'max'           => 0  // tham số max, min và max là 2 tham số private
    );

    // Hàm khởi tạo, kiểm tra và tính toán các thông số của class Pagination
    function init ($config = array()){
    	foreach ($config as $key => $val){
    		if (isset($this->_config[$key])){
    			$this->_config[$key] = $val;
    		}
    	}    
    	if ($this->_config['limit'] < 0){
    		$this->_config['limit'] = 0;
    	}
    	
    	$this->_config['total_page'] = ceil($this->_config['total_record'] / $this->_config['limit']);
    	if($this->_config['total_page'] < 1){
    		$this->_config['total_page'] = 1;
    	}

    	if($this->_config['current_page'] < 1){
    		$this->_config['current_page'] = 1;
    	}

    	if($this->_config['current_page'] > $this->_config['total_page']){
    		$this->_config['current_page'] = $this->_config['total_page'];
    	}
    	
    	$this->_config['start'] = ($this->_config['current_page'] - 1 ) * $this->_config['limit'];

    	// Xử lý số trang hiện ra màn hình
    	$middle = ceil($this->_config['range'] / 2);

    	if ($this->_config['total_page'] < $this->_config['range']){
    		$this->_config['min'] = 1;
    		$this->_config['max'] = $this->_config['total_page'];
    	}
    	else {
    		$this->_config['min'] = $this->_config['current_page'] - $middle + 1;
    		$this->_config['max'] = $this->_config['current_page'] + $middle - 1;

    		if($this->_config['min'] < 1){
    			$this->_config['min'] = 1;
    			$this->_config['max'] = $this->_config['range'];
    		}
    		else if ($this->_config['min'] > $this->_config['total_page']){
    			$this->_config['max'] = $this->_config['total_page'];
    			$this->_config['min'] = $this->_config['total_page'] - $this->_config['range']; 
    		}
    	}
    }

    // Hàm trả về thông số của pagination
    function get_config($key){
        return $this->_config[$key];
    }

    // Hàm lấy link theo trang
    private function __link($page) {
    	if ($page <= 1 && $this->_config['link_first']){
    		return $this->_config['link_first'];
    	}
    	return str_replace('{page}', $page, $this->_config['link_full']);
    }

    // Hàm tạo giao diện
    function html() {  
		$p = '';    	
    	if ($this->_config['total_record'] > $this->_config['limit']){
    		$p .= '<div class="product-pagination text-center"><nav><ul class="pagination">';



    		$displayFirst = $this->_config['current_page'] > 1 ? $this->__link('1') : '#';
    		$displayPrev = $this->_config['current_page'] > 1 ? $this->__link($this->_config['current_page']-1) : '#';

            $p .= '<li><a class="page" href="'.$displayFirst.'" aria-label="Previous"><span aria-hidden="true">&lt;&lt;</span></a></li>';
            $p .= '<li><a class="page" href="'.$displayPrev.'" aria-label="Previous"><span aria-hidden="true">&lt;</span></a></li>';

			// $p .= '<li><a '.$displayFirst.' >First</a></li>';
			// $p .= '<li><a '.$displayPrev.' >Prev</a></li>';    		

    		// Các trang ở giữa
    		for ($i=$this->_config['min']; $i<=$this->_config['max']; $i++){
    			// current page
    			if ($this->_config['current_page'] == $i){
    				$p .= '<li><span  style="background-color: cyan">'. $i .'</span></li>';
    			} else {
    				$p .= '<li><a class="page" href="'.$this->__link($i).'"> '.$i.' </a></li>';
    			}
    		}

    		// Next | Last
    		if ($this->_config['current_page'] < $this->_config['total_page']){ 
                $p .= '<li><a class="page" href="'.$this->__link($this->_config['current_page'] + 1).'" aria-label="Next"><span aria-hidden="true">&gt;</span></a></li>';
                $p .= '<li><a class="page" href="'.$this->__link($this->_config['total_page']).'" aria-label="Next"><span aria-hidden="true">&gt;&gt;</span></a></li>';

    			// $p .= '<li><a href="'. $this->__link($this->_config['current_page'] + 1).'">Next</a></li>';
    			// $p .= '<li><a href="'. $this->__link($this->_config['total_page']).'">Last</a></li>';
    		}
    		$p .= '</nav></div>';
    	}
		
		
		
		
    	return $p;
    }
}	

?>


<?php 

// How to use
// $config = array(
//         'current_page'  => isset($_GET['page']) ? $_GET['page'] : 1, // Trang hiện tại
//         'total_record'  => $process_account->total_accounts(),      // Tổng số record
//         'limit'         => $_SESSION['rpp'],                // limit
//         'link_full'     => '?view=admin&page={page}',// Link full có dạng như sau: domain/com/page/{page}
//         'link_first'    => '?view=admin',   // Link trang đầu tiên       
//     );

// $paging->init($config);

// echo $paging->html();

?>