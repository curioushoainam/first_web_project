<?php
require_once ('./class/Products.php');
$products = new Products();
$productsList = $products->list_products();
?>

<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead >
        <tr class="success">
            <th style="width: 3%"><input type="checkbox" name="" value=""></th>
            <th style="width: 37%; text-align: left;">Title</th>
            <th style="width: 10%; text-align: left;">Author</th>
            <th style="width: 5%">Tin mới</th>
            <th style="width: 5%">Hiển thị</th>
            <th style="width: 5%">View</th>
            <th style="width: 15%; text-align: left;">Ngày tạo</th>
            <th style="width: 15%; text-align: left;">Category</th>
            <th style="width: 5%">Todo</th>
        </tr>
    </thead>
    <tbody>
		<?php 
        foreach($productsList as $item){
            //echo $item->ten;
        ?>
        <tr>
            <td><input type="checkbox" name="" value=""></td>
            <td style="text-align: left;">.<?=  $item->ten; ?>.</td>
            <td style="text-align: left;">Author</td>
            <td><input type="checkbox" name="" value=""></td>
            <td><a href="#"><span class="glyphicon glyphicon-eye-open"></span></a></td>
            <!-- <td><span class="glyphicon glyphicon-eye-close"></span></span></td> -->
            <td>0</td>
            <td style="text-align: left;">Ngày tạo</td>
            <td style="text-align: left;">Category</td>
            <td>
            <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                 | 
                <a href="#"><span class="glyphicon glyphicon-trash"></span></a>

            </td>
        </tr>
        <?php
			}
		?>		    	
    </tbody>
  </table>
</div> 
