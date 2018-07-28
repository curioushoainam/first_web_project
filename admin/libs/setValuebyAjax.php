<?php 
if(isset($_POST["rpp"]) && $_POST["rpp"]){
	$_SESSION["rpp"] = $_POST["rpp"];
	
	echo '<p>'.$_SESSION["rpp"].'</p>';
}
?>