<?php
$validation = new Validation(); 
$databaseFuncs = new DatabaseFuncs();

// define variables and set to empty values
$input = array("ten"=>NULL, "alias"=>NULL, "ma_nhom"=>NULL, "noi_dung_chi_tiet"=>NULL, "noi_dung_tom_tat"=>NULL, "danh_sach_hinh"=>NULL, "tieu_de"=>NULL, "tu_khoa"=>NULL, "mo_ta"=>NULL, "ma_loai"=>NULL, "so_luong"=>NULL, "don_gia"=>NULL,"don_gia_cu"=>NULL, "trang_thai"=>NULL, "ngay_tao"=>NULL, "ngay_cap_nhat"=>NULL, "hinh"=>NULL, "hinh_chia_se"=>NULL);

$tenErr=$aliasErr=$ma_nhomErr=$noi_dung_chi_tietErr=$noi_dung_tom_tatErr=$danh_sach_hinhErr=$tieu_deErr=$tu_khoaErr=$mo_taErr=$ma_loaiErr=$so_luongErr=$don_giaErr=$don_gia_cuErr=$trang_thaiErr=$ngay_taoErr=$hinhErr=$hinh_chia_seErr='';

$hinhArr=$hinh_chia_seArr=array();
$feedback='';

if(isset($_GET['id']) && $_GET['id']){
    $data = $databaseFuncs->read('products',array('*'),array('ma'=>$_GET['id']));
    // viewArr($data);    
    $input["ten"] = isset($data[0]->ten) ? $data[0]->ten : NULL;
    $input["alias"] = isset($data[0]->alias) ? $data[0]->alias : NULL;
    $input["ma_nhom"] = isset($data[0]->ma_nhom) ? $data[0]->ma_nhom : NULL;
    $input["noi_dung_chi_tiet"] = isset($data[0]->noi_dung_chi_tiet) ? $data[0]->noi_dung_chi_tiet : NULL;
    $input["noi_dung_tom_tat"] = isset($data[0]->noi_dung_tom_tat) ? $data[0]->noi_dung_tom_tat : NULL;
    $input["danh_sach_hinh"] = isset($data[0]->danh_sach_hinh) ? $data[0]->danh_sach_hinh : NULL;
    $input["tieu_de"] = isset($data[0]->tieu_de) ? $data[0]->tieu_de : NULL;
    $input["tu_khoa"] = isset($data[0]->tu_khoa) ? $data[0]->tu_khoa : NULL;
    $input["mo_ta"] = isset($data[0]->mo_ta) ? $data[0]->mo_ta : NULL;
    $input["ma_loai"] = isset($data[0]->ma_loai) ? $data[0]->ma_loai : NULL;
    $input["so_luong"] = isset($data[0]->so_luong) ? $data[0]->so_luong : NULL;
    $input["don_gia"] = isset($data[0]->don_gia) ? $data[0]->don_gia : NULL;
    $input["don_gia_cu"] = isset($data[0]->don_gia_cu) ? $data[0]->don_gia_cu : NULL;
    $input["trang_thai"] = isset($data[0]->trang_thai) ? $data[0]->trang_thai : NULL;
    $input["ngay_tao"] = isset($data[0]->ngay_tao) ? $data[0]->ngay_tao : NULL;
    $input["ngay_cap_nhat"] = isset($data[0]->ngay_cap_nhat) ? $data[0]->ngay_cap_nhat : NULL;
    
    $input["hinh"] = isset($data[0]->hinh) ? $data[0]->hinh : NULL;
    $input["hinh_chia_se"] = isset($data[0]->hinh_chia_se) ? $data[0]->hinh_chia_se : NULL;   
    $input["danh_sach_hinh"] = isset($data[0]->danh_sach_hinh) ? $data[0]->danh_sach_hinh : NULL; 
}

$chitiet = array(
    'group1'=>array('Màn hình',NULL),
    'cnmh'=>array('Công nghệ màn hình:',NULL),
    'dpgmh'=>array('Độ phân giải:',NULL),
    'ktmh'=>array('Kích thước màn hình:',NULL),
    'mkcu'=>array('Mặt kính cảm ứng:',NULL),

    'group2'=>array('Hệ điều hành-CPU',NULL),
    'hdh'=>array('Hệ điều hành:',NULL),
    'cscpu'=>array('Chipset (hãng SX CPU):',NULL),
    'tdcpu'=>array('Tốc độ CPU:',NULL),
    'cdhgpu'=>array('Chip đồ họa (GPU):',NULL),

    'group3'=>array('Bộ nhớ',NULL),
    'ram'=>array('RAM:',NULL),
    'bnt'=>array('Bộ nhớ trong:',NULL),
    'tnn'=>array('Thẻ nhớ ngoài:',NULL),

    'group4'=>array('Kết nối',NULL),
    'mdd'=>array('Mạng di động:',NULL),
    'sim'=>array('SIM:',NULL),
    'wifi'=>array('Wifi:',NULL),
    'gps'=>array('GPS:',NULL),
    'blt'=>array('Bluetooth:',NULL),
    'ckn'=>array('Cổng kết nối/sạc:',NULL),
    'jtn'=>array('Jack tai nghe:',NULL),
    'knk'=>array('Kết nối khác:',NULL),

    'group5'=>array('Camera sau',NULL),
    'dpgcs'=>array('Độ phân giải:',NULL),
    'qp'=>array('Quay phim:',NULL),
    'df'=>array('Đèn Flash:',NULL),
    'canc'=>array('Chụp ảnh nâng cao:',NULL),

    'group6'=>array('Camera trước',NULL),
    'dpgct'=>array('Độ phân giải:',NULL),
    'vdc'=>array('Videocall:',NULL),
    'ttk'=>array('Thông tin khác:',NULL),

    'group7'=>array('Thiết kế',NULL),
    'tk'=>array('Thiết kế:',NULL),
    'cl'=>array('Chất liệu:',NULL),
    'kt'=>array('Kích thước:',NULL),
    'tl'=>array('Trọng lượng:',NULL),

    'group8'=>array('Pin & Sạc',NULL),
    'dlp'=>array('Dung lượng pin:',NULL),
    'lp'=>array('Loại pin:',NULL),

    'group9'=>array('Tiện ích',NULL),
    'bmnc'=>array('Bảo mật nâng cao:',NULL),
    'tndb'=>array('Tính năng đặc biệt:',NULL),
    'ga'=>array('Ghi âm:',NULL),
    'radio'=>array('Radio:',NULL)
);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['product_update']) && $_POST['product_update']){ 

        if(isset($_POST['ten']) && $_POST['ten']){
            $input['ten'] = $validation->test_input($_POST['ten']);          
        } else {
            $tenErr = '* err';         
        } 

        if(isset($_POST['alias']) && $_POST['alias']){
            $input['alias'] = $validation->test_input($_POST['alias']);
        } else {
            $aliasErr = '* err';
        }        

        if(isset($_POST['ma_nhom']) && $_POST['ma_nhom']){
            $input['ma_nhom'] = $validation->test_input($_POST['ma_nhom']);
            if(!is_numeric($input['ma_nhom'])){
            	$input['ma_nhom'] = '';
            	$ma_nhomErr = '* err';
            }
        } else {
            $ma_nhomErr = '* err';
        }        

        if(isset($_POST['noi_dung_tom_tat'])){
            $input['noi_dung_tom_tat'] = $validation->test_input($_POST['noi_dung_tom_tat']);
        } else {
            $noi_dung_tom_tatErr = '* err';
        } 

        if(isset($_POST['tieu_de'])){
            $input['tieu_de'] = $validation->test_input($_POST['tieu_de']);
        } else {
            $tieu_deErr = '* err';
        }

        if(isset($_POST['tu_khoa'])){
            $input['tu_khoa'] = $validation->test_input($_POST['tu_khoa']);
        } else {
            $tu_khoaErr = '* err';
        }

        if(isset($_POST['mo_ta'])){
            $input['mo_ta'] = $validation->test_input($_POST['mo_ta']);
        } else {
            $mo_taErr = '* err';
        }

        if(empty($_POST['ma_loai']) && $_POST['ma_loai'] !== '0'){
            $ma_loaiErr = '* err';                     
        } else {
            $input['ma_loai'] = $validation->test_input($_POST['ma_loai']);
            if (!is_numeric($input['ma_loai'])){
                $input['ma_loai'] = '';
                $ma_loaiErr = "* err";
            }           
        }

        if(isset($_POST['so_luong'])){
            $input['so_luong'] = $validation->test_input($_POST['so_luong']);
            if(!is_numeric($input['so_luong'])){
            	$input['so_luong'] = '';
            	$so_luongErr = '* err';
            }
        } else {
            $so_luongErr = '* err';
        }

        if(isset($_POST['don_gia'])){
            $input['don_gia'] = $validation->test_input($_POST['don_gia']);  
            $input['don_gia'] = filter_var($input['don_gia'], FILTER_SANITIZE_NUMBER_INT);
            if(!is_numeric($input['don_gia'])){
                viewArr($input['don_gia']);
            	$input['don_gia'] = 0;
            	$don_giaErr = '* err';
            }

        } else {
            $don_giaErr = '* err';
        }

        if(isset($_POST['don_gia_cu'])){
            $input['don_gia_cu'] = $validation->test_input($_POST['don_gia_cu']);
            $input['don_gia_cu'] = filter_var($input['don_gia_cu'], FILTER_SANITIZE_NUMBER_INT);
            if(!is_numeric($input['don_gia_cu'])){
                $input['don_gia_cu'] = 0;                
            }
        } else {
            $don_gia_cuErr = '* err';
        }

        if(empty($_POST['trang_thai']) && $_POST['trang_thai'] !== '0'){
            $trang_thaiErr = '* err';                     
        } else {
            $input['trang_thai'] = $validation->test_input($_POST['trang_thai']);
            if (!is_numeric($input['trang_thai'])){
                $input['trang_thai'] = '';
                $trang_thaiErr = "* err";
            }           
        }

        if(isset($_POST['hinh'])){                       
            $input['hinh'] = $validation->test_input($_POST['hinh']);
        }

         if(isset($_POST['hinh_cs'])){                       
            $input['hinh_chia_se'] = $validation->test_input($_POST['hinh_cs']);
        }

         if(isset($_POST['imgselected'])){
            $imgs = '';
            foreach ($_POST['imgselected'] as $img){
                $imgs .= $img .'||';
            }
            $imgs = rtrim($imgs,'||');            
            $input['danh_sach_hinh'] = $imgs;            
        } 

        // Product detail
			$chitiet['group1'][1] = '-';
			$chitiet['cnmh'][1] = isset($_POST['cnmh']) && $_POST['cnmh'] ? $_POST['cnmh'] : '-';
			$chitiet['dpgmh'][1] = isset($_POST['dpgmh']) && $_POST['dpgmh'] ? $_POST['dpgmh'] : '-';
		    $chitiet['ktmh'][1] = isset($_POST['ktmh']) && $_POST['ktmh'] ? $_POST['ktmh'] : '-';
		    $chitiet['mkcu'][1] = isset($_POST['mkcu']) && $_POST['mkcu'] ? $_POST['mkcu'] : '-';

		    $chitiet['group2'][1] = '-';
		    $chitiet['hdh'][1] = isset($_POST['hdh']) && $_POST['hdh'] ? $_POST['hdh'] : '-';
		    $chitiet['cscpu'][1] = isset($_POST['cscpu']) && $_POST['cscpu'] ? $_POST['cscpu'] : '-';
		    $chitiet['tdcpu'][1] = isset($_POST['tdcpu']) && $_POST['tdcpu'] ? $_POST['tdcpu'] : '-';
		    $chitiet['cdhgpu'][1] = isset($_POST['cdhgpu']) && $_POST['cdhgpu'] ? $_POST['cdhgpu'] : '-';

		    $chitiet['group3'][1] = '-';
		    $chitiet['ram'][1] = isset($_POST['ram']) && $_POST['ram'] ? $_POST['ram'] : '-';
		    $chitiet['bnt'][1] = isset($_POST['bnt']) && $_POST['bnt'] ? $_POST['bnt'] : '-';
		    $chitiet['tnn'][1] = isset($_POST['tnn']) && $_POST['tnn'] ? $_POST['tnn'] : '-';

		    $chitiet['group4'][1] = '-';
		    $chitiet['mdd'][1] = isset($_POST['mdd']) && $_POST['mdd'] ? $_POST['mdd'] : '-';
		    $chitiet['sim'][1] = isset($_POST['sim']) && $_POST['sim'] ? $_POST['sim'] : '-';
		    $chitiet['wifi'][1] = isset($_POST['wifi']) && $_POST['wifi'] ? $_POST['wifi'] : '-';
		    $chitiet['gps'][1] = isset($_POST['gps']) && $_POST['gps'] ? $_POST['gps'] : '-';
		    $chitiet['blt'][1] = isset($_POST['blt']) && $_POST['blt'] ? $_POST['blt'] : '-';
		    $chitiet['ckn'][1] = isset($_POST['ckn']) && $_POST['ckn'] ? $_POST['ckn'] : '-';
		    $chitiet['jtn'][1] = isset($_POST['jtn']) && $_POST['jtn'] ? $_POST['jtn'] : '-';
		    $chitiet['knk'][1] = isset($_POST['knk']) && $_POST['knk'] ? $_POST['knk'] : '-';

		    $chitiet['group5'][1] = '-';
		    $chitiet['dpgcs'][1] = isset($_POST['dpgcs']) && $_POST['dpgcs'] ? $_POST['dpgcs'] : '-';
		    $chitiet['qp'][1] = isset($_POST['qp']) && $_POST['qp'] ? $_POST['qp'] : '-';
		    $chitiet['df'][1] = isset($_POST['df']) && $_POST['df'] ? $_POST['df'] : '-';
		    $chitiet['canc'][1] = isset($_POST['canc']) && $_POST['canc'] ? $_POST['canc'] : '-';

		    $chitiet['group6'][1] = '-';
		    $chitiet['dpgct'][1] = isset($_POST['dpgct']) && $_POST['dpgct'] ? $_POST['dpgct'] : '-';
		    $chitiet['vdc'][1] = isset($_POST['vdc']) && $_POST['vdc'] ? $_POST['vdc'] : '-';
		    $chitiet['ttk'][1] = isset($_POST['ttk']) && $_POST['ttk'] ? $_POST['ttk'] : '-';

		    $chitiet['group7'][1] = '-';
		    $chitiet['tk'][1] = isset($_POST['tk']) && $_POST['tk'] ? $_POST['tk'] : '-';
		    $chitiet['cl'][1] = isset($_POST['cl']) && $_POST['cl'] ? $_POST['cl'] : '-';
		    $chitiet['kt'][1] = isset($_POST['kt']) && $_POST['kt'] ? $_POST['kt'] : '-';
		    $chitiet['tl'][1] = isset($_POST['tl']) && $_POST['tl'] ? $_POST['tl'] : '-';

		    $chitiet['group8'][1] = '-';
		    $chitiet['dlp'][1] = isset($_POST['dlp']) && $_POST['dlp'] ? $_POST['dlp'] : '-';
		    $chitiet['lp'][1] = isset($_POST['lp']) && $_POST['lp'] ? $_POST['lp'] : '-';

		    $chitiet['group9'][1] = '-';
		    $chitiet['bmnc'][1] = isset($_POST['bmnc']) && $_POST['bmnc'] ? $_POST['bmnc'] : '-';
		    $chitiet['tndb'][1] = isset($_POST['tndb']) && $_POST['tndb'] ? $_POST['tndb'] : '-';
		    $chitiet['ga'][1] = isset($_POST['ga']) && $_POST['ga'] ? $_POST['ga'] : '-';
		    $chitiet['radio'][1] = isset($_POST['radio']) && $_POST['radio'] ? $_POST['radio'] : '-';
		
        $input['noi_dung_chi_tiet'] = '';
		foreach($chitiet as $key => $val){
			$init = (substr($key,0,5)=='group')?'>>>|':'';
			$input['noi_dung_chi_tiet'] .= $init.$key.'||'.implode('||',$val). '|||';
		}	
        $input['noi_dung_chi_tiet'] = trim($input['noi_dung_chi_tiet'],'>>>|');
// viewArr($chitiet);

        if(!($tenErr||$aliasErr||$ma_nhomErr||$noi_dung_chi_tietErr||$noi_dung_tom_tatErr||$danh_sach_hinhErr||$tieu_deErr||$tu_khoaErr||$mo_taErr||$ma_loaiErr||$so_luongErr||$don_giaErr||$don_gia_cuErr||$trang_thaiErr)){

            $input['ngay_cap_nhat'] = date('Y-m-d H:i:s');
// viewArr($input);
			// $kq = '';                       
            $kq = $databaseFuncs->update('products',$input,array('ma'=>$_GET['id']));
            if($kq){
                foreach($input as $key => $val){
                    $input[$key] = NULL;
                }                
                 $feedback = '<h4 style="color:blue"><i>Cập nhật vào database thành công</i></h4>';
            } else 
                 $feedback = '<h4 style="color:red"><i>Cập nhật vào database Thất Bại</i></h4>';
        }         
    }
}

?>

<div class="product_add">
<div class="text-center"><?= $feedback ?></div>
<form action="" method="post" enctype="multipart/form-data">	
	<div class="">
		<div class="row">
			<div class="col-sm-6"><h4><a href="?view=product">Sản phẩm </a><span> >> Thay đổi thông tin</span></h4></div>
			<div class="col-sm-6 align-content-center" style="margin-top: 20px">
				<button class="btn btn-success" type="submit" value="true" name="product_update">Update</button>
				<a type="button" class="btn btn-default" href="?view=product">Cancel</a>
			</div>
		</div>
	<hr>	
		<div class="tabbable">
			<ul class="nav nav-tabs">
	            <li class="active"><a href="#general" data-toggle="tab"><b>Thông tin chung</b></a></li>
	            <li><a href="#detail" data-toggle="tab"><b>Chi tiết sản phẩm</b></a></li>	            
	            <li><a href="#seo" data-toggle="tab"><b>SEO</b></a></li>
	            <li><a href="#image" data-toggle="tab"><b>Hình ảnh</b></a></li>
          	</ul>
          	<div class="tab-content">
          		<div class="tab-pane active" id="general">          			
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<td class="leftCol success col-sm-3" style="font-size: 14px">Tên sản phẩm: <span class="error"><?= $tenErr?></span></td>
		            			<td class="rightCol"><input type="text" name="ten" id="ten" style="width: 100%; " value="<?= $input['ten'] ?>"></td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Alias: <span class="error"><?= $aliasErr?></span></td>
		            			<td class="rightCol"><input type="text" name="alias" id="alias" style="width: 100%; " value="<?= $input['alias'] ?>"></td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mã nhóm: <span class="error"><?= $ma_nhomErr?></span></td>
		            			<td class="rightCol"> 
		            				<select id="ma_nhom" name="ma_nhom" style="width: 100%; ">
									<?php
				                    $product_group = $databaseFuncs->read('product_group',array('ma','ten'));
				                    foreach($product_group as $item){
				                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
				                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
				                    }
				                    ?>  
				                    </select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Tóm tắt: <span class="error"><?= $noi_dung_tom_tatErr?></span></td>
		            			<td class="rightCol">		            				
		            				<textarea rows="3" id="noi_dung_tom_tat" name="noi_dung_tom_tat" style="width: 100%; " class="form-control" type="text"><?= $input['noi_dung_tom_tat'] ?></textarea>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mã loại: <span class="error"><?= $ma_loaiErr?></span></td>
		            			<td class="rightCol">		            				
		            				<select id="ma_loai" name="ma_loai" style="width: 100%; ">
				                    <?php
				                    $product_catalog = $databaseFuncs->read('product_catalog',array('ma','ten'));
				                    foreach($product_catalog as $item){
				                        $selectVar = $input['ma_nhom'] == $item->ma ? 'selected' : '';
				                        echo '<option '.$selectVar.' value="'. $item->ma .'">'.   $item->ten .'</option>';
				                    }
				                    ?>  
				                    </select>
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Số lượng: <span class="error"><?= $so_luongErr?></span></td>
		            			<td class="rightCol">
									<input id="so_luong" name="so_luong" type="number" style="width: 100%;" value="<?= $input['so_luong'] ?>">
		            			</td>
		            		</tr>

		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Đơn giá: <span class="error"><?= $don_giaErr?></span></td>
		            			<td class="rightCol">		            				
		            				<input id="don_gia" name="don_gia" style="width: 100%; " type="text" value="<?= number_format($input['don_gia']) ?>">
		            			</td>
		            		</tr>

                            <tr>
                                <td class="leftCol success" style="font-size: 14px">Đơn giá cũ: <span class="error"><?= $don_gia_cuErr?></span></td>
                                <td class="rightCol">                                   
                                    <input id="don_gia_cu" name="don_gia_cu" style="width: 100%; " type="text" value="<?= number_format($input['don_gia_cu']) ?>">
                                </td>
                            </tr>


		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Trạng thái: <span class="error"><?= $trang_thaiErr?></span></td>
		            			<td class="rightCol">
		            				
		            				<select id="trang_thai" name="trang_thai"style="width: 100%; ">
			                       <?php 
			                        $trang_thais = [0,1];
			                        foreach ($trang_thais as $item){
			                            $selectVar = $input['trang_thai'] == $item ? 'selected' : '';
			                            echo '<option '.$selectVar.' value="'. $item .'">'.   $item .'</option>'; 
			                        }
			                        ?>
			                   </select>
		            			</td>
		            		</tr>
		            		</tbody>
		        		</table>
		    		</div>
        		</div>

        		<div class="tab-pane" id="detail">
					<?php 
						include ('/pages/product_edit_detail.php');

					?>
				</div>				

        		<div class="tab-pane" id="seo">
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<td class="leftCol success col-sm-3" style="font-size: 14px">Tiêu đề: <span class="error"><?= $tieu_deErr?></span></td>
		            			<td class="rightCol">		            				
		            				<input id="tieu_de" name="tieu_de" type="text" style="width: 100%;" value="<?= $input['tieu_de'] ?>">
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Từ khóa: <span class="error"><?= $tu_khoaErr?></span></td>
		            			<td class="rightCol">
		            				<input id="tu_khoa" name="tu_khoa" style="width: 100%;" type="text" value="<?= $input['tu_khoa'] ?>">
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">Mô tả: <span class="error"><?= $mo_taErr?></span></td>
		            			<td class="rightCol">
		            				<textarea id="mo_ta" name="mo_ta" style="width: 100%;" type="text" rows="5"><?= $input['mo_ta'] ?></textarea>
		            			</td>
		            		</tr>	                		
		            		</tbody>
		        		</table>
		    		</div>
        		</div>

				<div class="tab-pane" id="image">
					<div class="col-md-8 col-md-offset-2">
		            	<table class="table">
		        			<tbody>
		            		<tr>
		            			<!-- <td class="leftCol success col-sm-3" style="font-size: 14px">Hình: </td> -->
		            			<td class="leftCol success col-sm-3" style="font-size: 14px"><input type="button" name="button1" id="button1" onclick="BrowseServer();" value="Chọn hình" class="btn btn-info" style="width:100%"> </td>
		            			<td class="rightCol">		            				
		            				<div class="col-sm-8" style="padding: 0px">				                        
				                        <input id="hinh" name="hinh" class="form-control" type="text" value="<?= $input['hinh'] ?>" >
				                    </div>
				                    <div class="col-sm-4" style="padding: 0px">                     
				                        <img alt="" height="75" id="img" src="<?= $input['hinh'] ?>" class="pull-right">
				                    </div>   
		            			</td>
		            		</tr>
		            		<tr>
		            			<td class="leftCol success" style="font-size: 14px">
		            				<input type="button" name="button1" id="button1" onclick="BrowseServerCS();" value="Hình chia sẽ" class="btn btn-info" style="width:100%">
		            			</td>
		            			<td class="rightCol">		            				
		            				<div class="col-sm-8" style="padding: 0px">				                        
				                        <input id="hinh_cs" name="hinh_cs" class="form-control " type="text" value="<?= $input['hinh_chia_se'] ?>" >
				                    </div>
				                    <div class="col-sm-4" style="padding: 0px">                     
				                        <img alt="" height="75" id="img_cs" src="<?= $input['hinh_chia_se'] ?>" class="pull-right">
				                    </div>
		            			</td>
		            		</tr>
                            <tr>
                                <td class="leftCol success" style="font-size: 14px">
                                    <input type="button" name="button1" id="button1" onclick="BrowseServerCS();" value="Danh sách hình đã up" class="btn btn-info" style="width:100%">
                                </td>
                                <td class="rightCol">                                   
                                    <div>                                     
                                        <input id="ds_hinh_up" name="ds_hinh_up" class="form-control " type="text" value="<?= $input['danh_sach_hinh'] ?>" style="width: 100%">                                        
                                    </div>
                                    <div>
                                        <?php 
                                        $imgs = explode('||',$input['danh_sach_hinh']);
                                        if (isset($imgs) && $imgs){
                                            foreach ($imgs as $img){                             
                                       ?>
                                            <div class="col-md-3 col-sm-4 col-xs-6" style="margin: 10px auto">
                                                    <img src="<?= $img ?>" alt="" width="50px" height="75px">
                                                    <?php $name = explode('/',$img);?>
                                                    <br><span><?= isset($name)?end($name):'' ?></span>
                                            </div>
                                       <?php 
                                            }
                                        };
                                        ?>
                                    </div>                                    
                                </td>
                            </tr>
		            		<tr>		            			
		            			<td class="leftCol success">
		            				<input type="button" name="btn_slmulimg" id="btn_slmulimg" value="Chọn danh sách hình" class="btn btn-info"  style="width:100%">
		            				<input type="button" id="selectAll" value="Select all" class="btn btn-default pull-right" style="width:50%">
		            			</td>
		            			<td class="rightCol">
		            				<div id="mulImages">
			            					<!-- Show Images -->
		            				</div>
		            			</td>
		            		</tr>	                		
		            		</tbody>
		        		</table>
		    		</div>
        		</div>
			</div>
		</div>
		<!-- /tabs -->
	</div>
</form>	
</div>



<script type="text/javascript" src="libs/asset/ckfinder/ckfinder.js"></script>
<script type="text/javascript"> 
    function BrowseServer(){
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '/First web project/admin/';  // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileField;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileField( fileUrl ){
        document.getElementById( 'hinh' ).value = fileUrl;      
        document.getElementById( 'img' ).setAttribute('src',fileUrl);
    }

    function BrowseServerCS(){
        // You can use the "CKFinder" class to render CKFinder in a page:
        var finder = new CKFinder();
        finder.basePath = '/First web project/admin/';  // The path for the installation of CKFinder (default = "/ckfinder/").
        finder.selectActionFunction = SetFileFieldCS;
        finder.popup();
    }
    // This is a sample function which is called when a file is selected in CKFinder.
    function SetFileFieldCS( fileUrl ){
        document.getElementById( 'hinh_cs' ).value = fileUrl;      
        document.getElementById( 'img_cs' ).setAttribute('src',fileUrl);
    }  

 //    $(document).ready(function(){
	// 	 $.ajax({
	//         url: 'class/API.php',
	//         type : "post",			// post method
 //            dataType : "text",		// data type of server respose
 //            data : {				// list of arguments will be sent to server

 //            	location : 'images'
 //            },
 //            success : function(response){	// call-back function uses for process server response which will store inside variable result
 //                $('#mulImages').html(response);
 //            },
 //            error : function (err){
 //            	 $('#mulImages').html(err);
 //            }
	//     });	    
	// });  

    $('#mulImages').on("click",".imgssl", function(event){
    	// alert($(this).attr('href'));
	    event.preventDefault(); 
	    $.ajax({
	        url: 'class/API.php',
	        type : "post",			// post method
            dataType : "text",		// data type of server respose
            data : {				// list of arguments will be sent to server

            	location : $(this).attr('href')
            },
            success : function(response){	// call-back function uses for process server response which will store inside variable result
                $('#mulImages').html(response);
            },
            error : function (err){
            	 $('#mulImages').html(err);
            }
	    });
	    return false; // for good measure
	});

	$('#btn_slmulimg').click(function(){
		 $.ajax({
	        url: 'class/API.php',
	        type : "post",			// post method
            dataType : "text",		// data type of server respose
            data : {				// list of arguments will be sent to server

            	location : 'images'
            },
            success : function(response){	// call-back function uses for process server response which will store inside variable result
                $('#mulImages').html(response);
            },
            error : function (err){
            	 $('#mulImages').html(err);
            }
	    });	    
	});

	var select = false;
	$('#selectAll').click(function(){
		if(!select){
			$('.imgsl').prop("checked",true);
			select = true;
		} else {
			$('.imgsl').prop("checked",false);
			select = false;
		}
	});

</script> 

<script>
    $(document).on('click','#alias', function(){        
        str2alias('ten','alias');
    });    
</script>