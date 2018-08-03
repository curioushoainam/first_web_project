<?php
require_once ('./class/DatabaseFuncs.php');
require_once ('./class/Validation.php');

$databaseFuncs = new DatabaseFuncs();
$validation = new Validation();

$feedback = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['article_delete']) && $_POST['article_delete']){
		if(isset($_POST['ma']) && $_POST['ma'])
			$ma = $validation->test_input($_POST['ma']);
		$result = $databaseFuncs->update('articles', array('ngay_cap_nhat'=>date('Y-m-d H:i:s'),'trang_thai'=>2), array('ma'=>$ma));
		if(!$result){
			$feedback = '<h4 style="color:red"><i>Xóa bản tin thất bại</i></h4>';
		} else {
			chuyentrang('?view=article');
		}
	}
}

if(isset($_GET['id']) && $_GET['id']){
	$article = $databaseFuncs->read('articles',array('ma','ten'),array('ma'=>$_GET['id']));    
}
$ma = isset($article[0]->ma) ? $article[0]->ma : '';
$ten = isset($article[0]->ten) ? $article[0]->ten : '';
?>

<div>
    <div class="text-center"><?= $feedback ?></div>
	<form class="well form-horizontal" action="" method="post" >
		<fieldset>
			<legend class="creation-border">Bạn có muốn xóa bản tin bên dưới không?</legend>
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
                        <button type="submit" class="btn btn-success" name="article_delete" id="article_delete" value="true">Delete</button>
                        <a type="button" class="btn btn-default" href="?view=article">Cancel</a>
                    </div>
                </div>      
            </div>
  		</fieldset>  
	</form>
	
</div>
