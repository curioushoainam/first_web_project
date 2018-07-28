<?php
//<!-- lưu tất cả các function dùng chung cho website -->
function viewArray($ar){
    echo '<pre>';
    print_r($ar);
    echo '</pre>';
}

function checklogin(){
	if(isset($_COOKIE['login'], $_COOKIE['account'], $_COOKIE['password']) && $_COOKIE['login'] && $_COOKIE['account'] &&  $_COOKIE['password']){
	$_SESSION['login'] = $_COOKIE['login']; 
	$_SESSION['account'] = $_COOKIE['account'];
	$_SESSION['password'] = $_COOKIE['password'];
    $_SESSION['avatar'] = $_COOKIE['avatar'];
	}
    if (isset($_SESSION['login']) && $_SESSION['login']){
        return true;
    } else
        return false;
}

function chuyentrang($link){
    header('location: '.$link);
}

/*
$file : $_FILES từ phía client gửi lên
$path : thư mục chứa file sau khi đc upload thành công
$name: tên file sẽ được lưu
$maxsize: kích thước lớn nhất cho phép upload, đơn vị MB
$extallow: loại file được phếp upload lên server
return : array("error" => "", "mesg" => "") với error = 1 : có lỗi, error = 0 : không lỗi 

*/
function upload_file($file,$path,$name='file_',$maxsize = 1,$extallow=array('jpg','jpge','png','gif')){
    $result = array("error" => "0", "msg" => "");    
    //kiem tra file ng dung chọn đã đc đẩy lên tmp server hay chưa  
    if (!($file && is_array($file) && count($file)==5)) {
        $result["error"] = 1;
        $result["mesg"] = 'lỗi file tmp server';
        return $result; 
    }   
    
    //kiêm tra kich thươc file  
    $limsize = $maxsize * 1024 * 1024;   
    if(($file['size']<=0) || ($file['size']>$limsize)){
        $result["error"] = 1;
        $result["msg"] = 'lỗi kích thước file';        
        return $result; 
    }
    
    // tách đuôi file và kiểm tra
    $exts = explode('.',$file['name']); 
    $ext = strtolower($exts[count($exts)-1]);       
    if (!(in_array($ext, $extallow))){
        $result["error"] = 1;
        $result["msg"] = 'lỗi file type';        
        return $result;
    }
    
    // tạo tên file để quản lý
    $name .= '_'.time();    
    
    // tạo fullpath upload lên server
    $fullpath = $path.'/'.$name.'.'.$ext;
    if(move_uploaded_file($file['tmp_name'], $fullpath)){
        $result["msg"] = $fullpath;
        return $result;
    } else {
        $result["error"] = 1;
        $result["msg"] = 'lỗi đường dẫn lưu trữ';
        return $result;
    }   
}
?>
