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

function treeview($permlist, $ma = 0, $is_sub=FALSE){		
	$attr = (!$is_sub) ? 'class="checktree"' : 'class="sub"';
	$tree = '<ul '.$attr.' >';		// open

	GLOBAL $permission;

	$chucnangs = $permission->readFuncOfFather($ma);
	foreach ($chucnangs as $chucnang){
		$ten = isset($chucnang->ten) ? $chucnang->ten : '';
		$ma = isset($chucnang->ma) ? $chucnang->ma : '';
		$tree .= '<li>';
		$tree .= '<input type="checkbox" name="chucnang[]" value="'.$ma.'" '.(isPerm($ma,$permlist)?'checked' : '').' /><label>'.$ten.'</label>';
		$sub = treeview($permlist, $ma, TRUE);
		$tree .= $sub.'</li>';
	}

	return $tree. '</ul>';		// close
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
			echo treeview($permlist);
			?>
			<br>
			<button class="btn btn-primary" name="grant" value="true">Submit</button>	
		</form>	
	</div>
</div>

<script>
	$(function(){
			$("ul.checktree").checktree();
	});
</script>
<script type="text/javascript">

	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();

</script>


