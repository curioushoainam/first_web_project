<?php
require_once ('./config.php');
require_once ('./libs/funcs.php');
require_once ('./class/database.php');
require_once ('./class/Article_group.php');
require_once ('./class/Validation.php');

$article = new Article_group();
$validation = new Validation();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['article_group_delete']) && $_POST['article_group_delete']){
		if(isset($_POST['ma']) && $_POST['ma'])
			$ma = $validation->test_input($_POST['ma']);
		$result = $article->delete_article_group(date('Y-m-d H:i:s'), $ma);
		if(!$result){
			echo '<script type="text/javascript">alert("'. 'Xóa trong database THẤT BẠI. Vui lòng kiểm tra lại' .'")</script>';
		} else {
			chuyentrang('?view=article_group');
		}
	}
}

if(isset($_GET['id']) && $_GET['id']){
	$group = $article->get_article_group($_GET['id']);
}
$ma = isset($group->ma) ? $group->ma : '';
$ten = isset($group->ten) ? $group->ten : '';
?>

<div>
	<form class="well form-horizontal" action="" method="post" >
		<fieldset>
			<legend class="creation-border">Bạn có muốn xóa group bên dưới không?</legend>
			<div class="form-group">
                <label class="col-md-2 control-label">Mã</label>
                <div class="col-md-8">
                   <input id="ma" name="ma" class="form-control lock" type="text" readonly value="<?= $ma ?>">
                </div>                
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Tên nhóm tin</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control lock" type="text" readonly value="<?= $ten ?>">
                </div>
            </div>
            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="article_group_delete" id="article_group_delete" value="true">Delete</button>
                        <a type="button" class="btn btn-default" href="?view=article_group">Cancel</a>
                    </div>
                </div>      
            </div>
  		</fieldset>  
	</form>
	
</div>
