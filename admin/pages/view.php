<div class="view" style="">	
	<div class="container-fluid" id="btn-control">		
		<div class="col-sm-2">
			<button type="button" class="btn btn-success" id="add-service" href="#"><span class="glyphicon glyphicon-plus"></span> Thêm dịch vụ</button>			
		</div>
		<div class="col-sm-4 dropdown">			
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" id="btn-select-active" href="#">Chọn thao tác <span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a href="#">Hiện</a></li>
					<li><a href="#">Ẩn</a></li>
					<li><a href="#">Xóa</a></li>					
				</ul>
			
		</div>	
		<div class="col-sm-6">
			<form role="form" class="form-horizontal" action="" >
				<div class="form-group">
					<input type="text" class="search" name="title" id="title" placeholder="title" >
					<select class="search" name="author" id="author">
						<option value="">-- select author --</option>
						<option value="-- variable --">-- variable --</option>						
					</select>
					<select class="search" name="category" id="category">
						<option value="">-- select category --</option>
						<option value="-- variable --">-- variable --</option>						
					</select>
					<button type="submit" class="btn btn-primary btn-sm" name="btn-search" id="btn-search" href="#"><span class="glyphicon"></span> Search</button>
					
				</div>
			</form>
		</div>
	</div>
	
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
	    	<tr>
	    		<td><input type="checkbox" name="" value=""></td>
	    		<td style="text-align: left;">Title</td>
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
	    </tbody>
	  </table>
	</div> 
       
</div>
