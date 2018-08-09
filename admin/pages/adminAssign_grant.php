<?php 
if(isset($_GET['id']) && $_GET['id']){
	require_once ('./class/Permission.php');
	$permission = new Permission();	

	if(isset($_POST['grant']) && $_POST['grant']){
		$result = true;
		if(isset($_POST['chucnang']) && $_POST['chucnang']) {			
			// thu hoi quyen truoc
			$permission->revoke($_GET['id']);
			// cap quyen
			//viewArr($_POST['chucnang']);
			foreach ($_POST['chucnang'] as $machucnang){
				$result &= $permission->grantUser($machucnang, $_GET['id']);
			}			
		}
		if($result)
			$_SESSION['msg'] = 'Phân quyền thành công cho id => '.$_GET['id'];
		else 
			$_SESSION['msg'] = 'Phân quyền thất bại cho id => '.$_GET['id'];
		chuyentrang('?view=adminAssign');
	}	

	$user = $permission->readUserInfo($_GET['id']);
	// viewArr($user);
	if(isset($user) && $user){
		$ma = isset($user->ma) ? $user->ma : '';
		$ten = isset($user->ho_ten) ? $user->ho_ten : '';
		$nhom = isset($user->ma_nhom) ? $user->ma_nhom : '';
	}

	// doc phan quyen da duoc phan
	$permlist = $permission->readFuncOfUser($_GET['id']);
}

function isPerm($function, $permlist){

	foreach($permlist as $perm){		
		if($perm->ma_chuc_nang == $function){
			return true;
		}		
	}
	return false;
}



?>

<div class="admin_grant">
	<h4><span><a href="?view=adminAssign"><b>Danh sách người dùng </b></a></span> >> Phân quyền cho người dùng</h4>
	<br>
	<div align="center">
		<table width="40%" border="1">
			<tr>
				<th>Mã</th><th>Tên</th><th>Nhóm</th>
			</tr>
			<tr>
				<td><?= $ma ?></td><td><?= $ten ?></td><td><?= $nhom ?></td>			
			</tr>
		</table>
	</div>
	<hr>
	<div class="col-sm-offset-4">
		<form action="" method="post">
		<?php 
			$chucnangchas = $permission->readFuncOfFather();
			foreach ($chucnangchas as $chucnangcha){
				$tencha = isset($chucnangcha->ten) ? $chucnangcha->ten : '';
				$macha = isset($chucnangcha->ma) ? $chucnangcha->ma : '';
				echo '<label><input type="checkbox" '. (isPerm($macha,$permlist)?'checked' : '') .' name="chucnang[]" value="'.$macha.'"> '.$tencha.'</label><br>';
				$chucnangcons = $permission->readFuncOfFather($macha);
				foreach ($chucnangcons as $chucnangcon){
					$ten = isset($chucnangcon->ten) ? $chucnangcon->ten : '';
					$ma = isset($chucnangcon->ma) ? $chucnangcon->ma : '';
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<label><input type="checkbox" '. (isPerm($ma,$permlist)?'checked' : '') .' name="chucnang[]" value="'.$ma.'"><span style="font-style: normal;"> '.$ten.'</span></label><br>';
				}		
			}
		?>
		<br>
		<button class="btn btn-primary" name="grant" value="true">Submit</button>	
		</form>
	</div>
</div>


