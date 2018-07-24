<?php
// Regular Expression
class Validation {

	// Input : any data
	// Output : data after removing unnecessary space at the beginning, slash and html special chars 
	function test_input($data) {		
		$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;		
	}
	
	// Input : $email data
	// Output : true or false	
	function isEmail($email){		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		} else {
			return false;
		}
	}	

	// Desc: Password need lower and capital and special char , number and special char; length from 8 to 15 chars 
	// Input : $password data
	// Output : true or false
	function isPassword($password){		
		$parttern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])[A-Za-z0-9\W]{8,15}$/';
		if(preg_match($parttern, $password)){
			return true;
		} else {
			return false;
		}		
	}

	// Desc: check $var whether it is a number or not and length from lower times to upper times. Default is minimum 1 digit
	// Input : variable, lower times, upper times
	// Output : true or false
	function isNumber($var, $lower = 1, $upper = ''){
		$parttern = '/^(?=.*[0-9])[0-9]{'. $lower .','. $upper .'}$/';
		if(preg_match($parttern, $var)){
			return true;
		} else {
			return false;
		}
	}

	// Desc: check $var whether it is a common chars (included '_') or not and length from lower times to upper times. Default is minimum 1 digit
	// Input : variable, lower times, upper times
	// Output : true or false
	function isCommonChars($var, $lower = 1, $upper = ''){
		$parttern = '/^(?=.*[\w_])[\w_]{'. $lower .','. $upper .'}$/';
		if(preg_match($parttern, $var)){
			return true;
		} else {
			return false;
		}
	}	
}

?>