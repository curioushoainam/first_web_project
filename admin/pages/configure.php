<?php 
require_once ('./class/Database.php');
require_once ('./class/Configure.php');

$configure = new Configure();

?>

<div class="configure">
	<h3><i class="fa fa-cogs fa-fw"></i>  Configure Manager</h3>
	<hr>
	<ul class="nav nav-tabs" id="configure">
	    <li class="active"><a data-toggle="tab" href="#general">General Info</a></li>
	    <li><a data-toggle="tab" href="#smtp">SMTP</a></li>
	    <li><a data-toggle="tab" href="#seo">SEO</a></li>
	    <li><a data-toggle="tab" href="#footer">Footer</a></li>
  	</ul>
	
	<div class="tab-content">
    <div id="general" class="tab-pane fade in active">
    	<?php 
    		require_once ('./pages/configure_general.php');
    	?>    	
    </div>

    <div id="smtp" class="tab-pane fade">    
		<?php 
    		require_once ('./pages/configure_smtp.php');
    	?>
    </div>
    <div id="seo" class="tab-pane fade">      
		<?php 
    		require_once ('./pages/configure_seo.php');
    	?>
    </div>
    <div id="footer" class="tab-pane fade">
	 	<?php 
    		require_once ('./pages/configure_footer.php');
    	?>
    </div>
  </div>

<script>
	$(document).ready(function(){
	    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
	        localStorage.setItem('activeTab', $(e.target).attr('href'));
	    });
	    var activeTab = localStorage.getItem('activeTab');
	    if(activeTab){
	        $('#configure a[href="' + activeTab + '"]').tab('show');
	    }
	});
</script>
</div>