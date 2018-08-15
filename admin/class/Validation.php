<?php
// Regular Expression
class Validation {
	
	function test_input($data) {
		// Input : any data
		// Output : data after removing unnecessary space at the beginning, slash and html special chars 		
		$data = trim($data);
	  	$data = stripslashes($data);
	  	// $data = htmlspecialchars($data);
	  	return $data;		
	}	
		
	function isEmail($email){
		// Input : $email data
		// Output : true or false
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		} else {
			return false;
		}
	}
	
	function isPassword($password){	
		// Desc: Password need lower and capital and special char , number and special char; length from 8 to 15 chars 
		// Input : $password data
		// Output : true or false	
		$parttern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])[A-Za-z0-9\W]{8,15}$/';
		if(preg_match($parttern, $password)){
			return true;
		} else {
			return false;
		}		
	}

	
	function isNumber($var, $lower = 1, $upper = ''){
		// Desc: check $var whether it is a number and length from lower times to upper times. Default is minimum 1 digit
		// Input : variable, lower times, upper times
		// Output : true or false
		$parttern = '/^(?=.*[0-9])[0-9]{'. $lower .','. $upper .'}$/';
		if(preg_match($parttern, $var)){
			return true;
		} else {
			return false;
		}
	}
	
	function isCommonChars($var, $lower = 1, $upper = ''){
		// Desc: check $var whether it is a common chars (included '_' and space) and length from lower times to upper times. Default is minimum 1 digit
		// Input : variable, lower times, upper times
		// Output : true or false
		$parttern = '/^(?=.*[\w_])[\w_ ]{'. $lower .','. $upper .'}$/';
		if(preg_match($parttern, $var)){
			return true;
		} else {
			return false;
		}
	}	
}

?>