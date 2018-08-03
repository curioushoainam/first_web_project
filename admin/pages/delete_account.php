<?php

require_once ('./../config.php');
require_once ('./../class/database.php');
require_once ('./../class/Process_account.php');
require_once ('./../class/Validation.php');

$process_account = new Process_account();
$validation = new Validation();

if(isset($_POST['del_ma']) && $_POST['del_ma']){    
    $ma = $validation->test_input($_POST['del_ma']);  
      
    if (!$validation->isNumber($ma)){
        exit ('Mã sản phẩm không hợp lệ'); 
    }
    $account = $process_account->getAccountInfo($ma);       
    $output = '';
    $output .= '        
            <div class="deleting" id="'.$ma.'" style="text-align: center; color: blue;" >  
               <p><b>Tài khoản "'. $account->ten_dang_nhap .'" sẽ được xóa</b></p>
            </div>';            
    echo $output;
}

if(isset($_POST['deleted_ma']) && $_POST['deleted_ma']){
    $ma = $validation->test_input($_POST['deleted_ma']);    
    if (!$validation->isNumber($ma)){
        exit ('Mã sản phẩm không hợp lệ'); 
    }
    $account = $process_account->getAccountInfo($ma);
    $result = $process_account->delete_account(date("Y-m-d h:m:s"),$ma); 
     
    $output = '';
    if($result){
        $output .= '        
            <div class="deleting" style="text-align: center; color: blue;" >  
               <p><b>Xóa tài khoản "'. $account->ten_dang_nhap .'" thành công</b></p>
            </div>'; 
        echo $output;
    } else {
        $output .= '        
            <div class="deleting" style="text-align: center; color: blue;" >  
               <p><b>Xóa tài khoản "'. $account->ten_dang_nhap .'" thất bại</b></p>
            </div>';
        echo $output;
    }    
    
}

?>

