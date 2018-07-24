<div class="content" style="">	
	<form action="">
		<fieldset class="creation-border">
			<legend class="creation-border">Tạo mới</legend>
			<div class="input-group">
				<span class="input-group-addon" >Author*</span>
				<input type="text" class="form-control" name="" id="author">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Title*</span>
				<input type="text" class="form-control" name="" id="title">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Link*</span>
				<input type="text" class="form-control" name="" id="link">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Youtube ID*</span>
				<input type="text" class="form-control" name="" id="youtubeid">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Category*</span>
				<input type="text" class="form-control" name="" id="category">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Brief*</span>
				<textarea class="form-control" rows="4" id="brief"></textarea>
			</div>
			<div class="input-group">
			<!-- <div> -->
				<span class="input-group-addon" >Content*</span>
				<!-- <textarea class="form-control" rows="4" id="content"></textarea> -->
				<?php
					echo ckeditor('content', "", 'advance');
				?>
			</div>

			<p>Main image:</p>
			<input type="file" name="" id="" multiple size="50" accept=".gif, .jpg, .png">
			<div class="checkbox">
				<label><input type="checkbox" checked value="">is Hot</label>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" value="">is Special</label>
			</div>
			<div class="checkbox">
				<label><input type="checkbox" value="">is Comment</label>
			</div>

			<div class="input-group">
				<span class="input-group-addon" >SEO Title*</span>
				<input type="text" class="form-control" name="" id="youtubeid">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Meta Keywords</span>
				<input type="text" class="form-control" name="" id="category">
			</div>
			<div class="input-group">
				<span class="input-group-addon" >Meta Description</span>
				<textarea class="form-control" rows="4" id="brief"></textarea>
			</div>

			<div class="form-group" >
				<div class="col-sm-7" style="text-align: right;">
					<button type="submit" class="btn btn-success" name="" id="">Submit</button>
				</div>
				<div class="col-sm-offset-7">
					<button type="submit" class="btn btn-default" name="cancel" id="cancel" >Cancel</button>
				</div>
				
			</div>						
		</fieldset>
	</form>
	  
</div>
