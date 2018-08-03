<?php 
	
?>


<form class="well form-horizontal" method="post" enctype="multipart/form-data">
	<fieldset class="creation-border">
		<legend class="creation-border">
			<div class="pull-left">General information </div>
			<div class="pull-right"><input type="button" class="btn btn-info" id="general_edit" name="general_edit" value="Edit"></div>		
		</legend>        

	    <div class="form-group">
	        <label class="col-md-2 control-label">Company Name</label>
	        <div class="col-md-8">
	           <input id="company_name" name="company_name" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">Phone Number</label>
	        <div class="col-md-8">
	           <input id="phone_number" name="phone_number" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">Adress</label>
	        <div class="col-md-8">
	           <input id="adress" name="adress" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">Map</label>
	        <div class="col-md-8">
	           <input id="map" name="map" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>
		
	    <div class="form-group">
	        <label class="col-md-2 control-label">Company Email</label>
	        <div class="col-md-8">
	           <input id="company_email" name="company_email" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">Facebook</label>
	        <div class="col-md-8">
	           <input id="facebook" name="facebook" class="form-control" type="text" readonly>
	        </div>
	        <div class="col-md-2 error">
	            <p></p>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="col-md-2 control-label">Youtube</label>
	        <div class="col-md-8">
	           <input id="youtube" name="youtube" class="form-control" type="text" readonly>
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