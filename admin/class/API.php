<?php 
require_once('./../config.php');
require_once('./../libs/funcs.php');


if($_SERVER["REQUEST_METHOD"] == "POST"){
	$feedback = '';	
	if (isset($_POST['location']) && $_POST['location']){
		$folder = $_POST['location'];
		$root = './../';
		$name = 'imgselected';		
		$feedback = selectImages2($folder,$root,$name);

    } 
	echo $feedback;
}

?>