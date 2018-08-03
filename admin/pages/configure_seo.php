<?php 
	
?>


<form class="well form-horizontal" method="post" enctype="multipart/form-data">
	<fieldset class="creation-border">
		<legend class="creation-border">
			<div class="pull-left">SEO Setting </div>
			<div class="pull-right"><input type="button" class="btn btn-info" name="seo_edit" value="Edit"></div>		
		</legend>        

	    <div class="form-group">
	        <label class="col-md-2 control-label">Company Name</label>
	        <div class="col-md-8">
	           <input id="" name="company_name" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    
         <!-- inputGroupContainer -->
		<div class="form-group" >
			<div class="col-md-8 col-md-offset-2">
				<div class="pull-right" style="text-align: right;">
					<button type="button" class="btn btn-success" name="general" onclick="this.form.submit()">Save</button>
					<button type="button" class="btn btn-default" name="general" onclick="#">Cancel</button>
				</div>
			</div>		
		</div>						
	</fieldset>
</form>