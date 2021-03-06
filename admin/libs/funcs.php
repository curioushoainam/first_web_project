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
 

function myuploads($file,$path,&$kq,&$loi,$namein = 'file_',$maxsize=1,$extallow=array('jpg','png','gif')){
    // Upload multiple files to server
    
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


//$basedir = isset($_GET['fd']) && $_GET['fd'] ? $_GET['fd'] : 'images';
function selectImages($folder = 'images',$filename='?view=home',$name='imgselected'){
    /*input : 
        - $folder là folder chứa hình ảnh
        - $filename là url để chạy file gọi hàm
        - BASEURL được định nghĩa trong config.php. Nó định rõ đường dẫn từ gốc tới $folder
        - $basedir lấy vị trí folder dựa &fd=folder_name trên url
        - "imgselected[]" là name để PHP use $_POST lấy dữ liệu
    */
    $f = opendir($folder);
     echo '<div><p id="fd" style="color: blue">'.$folder.'/<p></div>';
    while(($file = readdir($f))){
        $ext = explode('.', $file);
        $ext = isset($ext[count($ext)-1]) ? $ext[count($ext)-1] : '';
        $pathfile = $folder.'/'.$file;  
        if(is_file($pathfile) && in_array($ext, array('jpg','png','gif','bmp'))){
            echo '<div class="col-md-3 col-sm-4 col-xs-6" style="margin: 10px auto"><img src="'.BASEURL.$pathfile.'" width="100px" height="70px"/><br>
                    <span style="font-size: 13px">'.$file.'</span>
                    <input class="imgsl" type="checkbox" name="'.$name.'[]" value="'.BASEURL.$pathfile.'">
            </div>';
        } else if (!is_file($pathfile) && $file != '.' && $file != '..' ) {
            $pathfolder = $filename.'&fd='.$folder.'/'.$file;
            echo '<div class="col-md-3 col-sm-4 col-xs-6" style="margin: 10px auto"><a class="imgssl" href="'.$pathfolder.'"><img src="'.BASEURL.'images/fd.png" width="100px" height="70px">                                      
                    <br><span style="font-size: 13px">'.$file.'</span></a>
            </div>'; 
        }
    }
}


function selectImages2($folder = 'images',$root = './',$name='imgs'){
/* 
    Hàm hiển thị danh sách ảnh và cho chọn nhiều ảnh
    
    input :         
        - $folder là folder chứa hình ảnh
        - BASEURL được định nghĩa trong config.php. Nó định rõ đường dẫn từ gốc tới $folder
        - $root  lấy vị trí folder dựa &fd=folder_name trên url
        - "imgs" là name để PHP use $_POST lấy dữ liệu

    output : hàm trả về dạng text đoạn mã html gồm đường dẫn và hình ảnh
*/
    $html = '';
    if(is_dir($root.$folder)){
        $f = opendir($root.$folder);                 
        $html .= '<div><p id="fd" style="color: blue">'.BASEURL.$folder.'/<p></div>';
        while(($file = readdir($f))){
            $ext = explode('.', $file);
            $ext = isset($ext[count($ext)-1]) ? $ext[count($ext)-1] : '';
            $pathfile = $folder.'/'.$file;  
            if(is_file($root.$pathfile) && in_array($ext, array('jpg','png','gif','bmp'))){
                $html .= '<div class="col-md-3 col-sm-6 col-xs-12" style="margin: 10px auto"><img src="'.BASEURL.$pathfile.'" height="70px" width="100"/><br>
                        <span style="font-size: 13px">'.$file.'</span>
                        <input class="imgsl" type="checkbox" name="'.$name.'[]" value="'.BASEURL.$pathfile.'">
                </div>';
            } else if (!is_file($pathfile) && $file != '.' && $file != '..' ) {
                $pathfolder = $folder.'/'.$file;
                $html .= '<div class="col-md-3 col-sm-6 col-xs-12" style="margin: 10px auto"><a class="imgssl" href="'.$pathfolder.'"><img src="'.BASEURL.'images/fd.png" height="70px" width="80">                                      
                        <br><span style="font-size: 13px">'.$file.'</span></a>
                </div>'; 
            }
        }
        closedir($f);
    } else 
        $html = 'Folder không tồn tại';

    return $html;
}

?>
