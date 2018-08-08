<?php
require_once ('./class/DatabaseFuncs.php');
require_once ('./class/Validation.php');

$databaseFuncs = new DatabaseFuncs();
$validation = new Validation();

$feedback = NULL;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['delete']) && $_POST['delete']){
		if(isset($_POST['ma']) && $_POST['ma'])
			$ma = $validation->test_input($_POST['ma']);
		$result = $databaseFuncs->update('products', array('ngay_cap_nhat'=>date('Y-m-d H:i:s'),'trang_thai'=>2), array('ma'=>$ma));
		if(!$result){
			$feedback = '<h4 style="color:red"><i>Xóa sản phẩm thất bại</i></h4>';
		} else {
			chuyentrang('?view=products');
		}
	}
}

if(isset($_GET['id']) && $_GET['id']){
	$product = $databaseFuncs->readarow('products',array('ma','ten','hinh'),array('ma'=>$_GET['id']));    
}
$ma = isset($product->ma) ? $product->ma : '';
$ten = isset($product->ten) ? $product->ten : '';
$hinhArr = isset($product->hinh) ? $product->hinh : '';
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
                <label class="col-md-2 control-label">Tên sản phẩm</label>
                <div class="col-md-8">
                   <input id="ten" name="ten" class="form-control lock" type="text" readonly value="<?= $ten ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Hình</label>
                <div class="col-md-8">
                    <?php 
                    $hinhs = explode("|",$hinhArr);
                    foreach($hinhs as $hinh){
                        echo '<img src="images/products/'. $hinh .'" alt="Images" height="100px"> ';
                    }
                    ?>
                                      
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-8 col-md-offset-2">
                    <div class="pull-right" style="text-align: right;">
                        <button type="submit" class="btn btn-success" name="delete" id="delete" value="true">Delete</button>
                        <a type="button" class="btn btn-default" href="?view=products">Cancel</a>
                    </div>
                </div>      
            </div>
  		</fieldset>  
	</form>
	
</div>
