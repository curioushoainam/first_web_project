<?php
//<!-- lưu tất cả các function dùng chung cho website -->
function viewArr($ar){
    echo '<pre>';
    print_r($ar);
    echo '</pre>';
}

function checklogin(){
    require_once ('./class/Process_account.php');
    $process_account = new Process_account();
    
	if(isset($_COOKIE['login'], $_COOKIE['account'], $_COOKIE['password']) && $_COOKIE['login'] && $_COOKIE['account'] &&  $_COOKIE['password']){
    	$_SESSION['login'] = $_COOKIE['login']; 
    	$_SESSION['account'] = $_COOKIE['account'];
    	$_SESSION['password'] = $_COOKIE['password'];
        
        if(isset($_COOKIE['avatar']) && $_COOKIE['avatar']){
            $_SESSION['avatar'] = $_COOKIE['avatar'];
        }
        
	}

    if (isset($_SESSION['login']) && $_SESSION['login']){
        if($process_account->isActive($_SESSION['account'])){
            return true;
        } else {
            $_SESSION['msg'] = 'Tài khoản đã bị khóa. Vui lòng liên hệ với admin';
            return false;
        }
        
    } else
        return false;
}

function checkpermission(){
    require_once ('./class/Process_account.php');
    $process_account = new Process_account();
    require_once ('./class/Permission.php');
    $permission = new Permission();    

    if (isset($_GET['view']) && $_GET['view']){
        $curlink = explode("_",$_GET['view'])[0];
        if ($curlink == 'logout' || $curlink == 'error' || $curlink == 'home')
            return true;
    } else 
        return true;        // ai cũng vào trang chủ được


    if (isset($_SESSION['account']) && $_SESSION['account']) {
        $mng = $process_account->getMngLevel($_SESSION['account']);

        // manager có toàn quyền
        if(isset($mng) && $mng)
            return true;
        // việc set quyền chỉ cho manager thực hiện
        if ($curlink == 'adminAssign'){
            return false;
        }

        $links = $permission->readLinkOfUser($process_account->getID($_SESSION['account'])); 

        foreach ($links as $link){           
            if($link->link == $curlink)
                return true;
        }
        return false;

    } else 
        return false;
}  


function notify(){
    if (isset($_SESSION['msg']) && $_SESSION['msg']){
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
    } else
        $msg = '';

    return $msg;
}


function chuyentrang($link){
    header('location: '.$link);
    exit();
}

/*
$file : $_FILES từ phía client gửi lên
$path : thư mục chứa file sau khi đc upload thành công
$name: tên file sẽ được lưu
$maxsize: kích thước lớn nhất cho phép upload, đơn vị MB
$extallow: loại file được phếp upload lên server
return : array("error" => "", "mesg" => "") với error = 1 : có lỗi, error = 0 : không lỗi 

*/
function upload_file($file,$path,$name='file_',$maxsize = 1,$extallow=array('jpg','jpge','png','gif'), $i=''){
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
    $name .= '_'.time().$i;    
    
    // tạo fullpath upload lên server
    $fullpath = $path.'/'.$name.'.'.$ext;
    if(move_uploaded_file($file['tmp_name'], $fullpath)){
        $result["msg"] = $name.'.'.$ext;
        return $result;
    } else {
        $result["error"] = 1;
        $result["msg"] = 'lỗi đường dẫn lưu trữ';
        return $result;
    }   
}

/*
Chuyển đổi các [file] post lên thành mảng các file với mỗi file có 
*/
function re_files_array($file_post){
    $newArray = array();   
    
    foreach($file_post as $keys => $all_vals){
        foreach($all_vals as $i => $val){
            $newArray[$i][$keys] =  $val;
        }           
    } 
    return $newArray;
}

function checkFile($file,$maxsize = 1,$extallow=array('jpg','jpge','png','gif')){
    $err = false;    
    //kiem tra file ng dung chọn đã đc đẩy lên tmp server hay chưa  
    if (!($file && is_array($file) && count($file)==5)) {        
        $err = 'lỗi file tmp server';
        return $err; 
    }   
    
    //kiêm tra kich thươc file  
    $limsize = $maxsize * 1024 * 1024;       
    if(($file['size']<=0) || ($file['size']>$limsize)){        
        $err = 'lỗi kích thước file';        
        return $err; 
    }
    
    // tách đuôi file và kiểm tra
    $exts = explode('.',$file['name']); 
    $ext = strtolower($exts[count($exts)-1]);       
    if (!(in_array($ext, $extallow))){        
        $err = 'lỗi file type';        
        return $err;
    } 
    return $err;
}

function upfile($file,$path,$name='file_'){    
    
    // tách đuôi file và kiểm tra
    $exts = explode('.',$file['name']); 
    $ext = strtolower($exts[count($exts)-1]);

    // tạo tên file để quản lý
    $name .= time();    
    
    // tạo fullpath upload lên server
    $fullpath = $path.'/'.$name.'.'.$ext;
    if(move_uploaded_file($file['tmp_name'], $fullpath)){
        $result = $name.'.'.$ext;
        return $result;
    } else {        
        return false;
    }   
}
 
/*
Upload multiple files to server
*/
function myuploads($file,$path,&$kq,&$loi,$namein = 'file_',$maxsize=1,$extallow=array('jpg','png','gif')){
    $kq = array();
    $loi=array();
    
    if(is_array($file) && is_array($file['name'])){
        foreach($file['name'] as $i=>$name){
            //tạo mảng các thông tin cua 1 file de upload
            $item = array(
                            'name'=>$name,
                            'tmp_name'=>$file['tmp_name'][$i],
                            'error'=>$file['error'][$i],
                            'size'=>$file['size'][$i],
                            'type'=>$file['type'][$i]           
                          );
            $err = checkFile($item,$maxsize,$extallow);
            if(!$err){
                $kqi = upfile($item,$path,$namein.$i);
                if($kqi)
                    $kq[] = $kqi;
                else
                    $loi[] = $name.' => Upload không thành công';
            } else {
                $loi[] = $name .' => '. $err;
            }             
        }
        return true;            
    }else
        return false;
}

?>
