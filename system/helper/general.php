<?php
function token($length = 32) {
	$string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	
	$max = strlen($string) - 1;
	
	$token = '';
	
	for ($i = 0; $i < $length; $i++) {
		$token .= $string[mt_rand(0, $max)];
	}	
	
	return $token;
}

if(!function_exists('hash_equals')) {
	function hash_equals($known_string, $user_string) {
		$known_string = (string)$known_string;
		$user_string = (string)$user_string;

		if(strlen($known_string) != strlen($user_string)) {
			return false;
		} else {
			$res = $known_string ^ $user_string;
			$ret = 0;

			for($i = strlen($res) - 1; $i >= 0; $i--) $ret |= ord($res[$i]);

			return !$ret;
		}
	}
}

function ordinal($number) {  

	// when fed a number, adds the English ordinal suffix. Works for any  
	// number, even negatives  
	
	if ($number % 100 > 10 && $number %100 < 
	14):  
	$suffix = "th";  
	else:  
	switch($number % 10) {  
	
	case 0: 
	$suffix = "th";  
	break;  
	
	case 1:  
	$suffix = "st";  
	break;  
	
	case 2:  
	$suffix = "nd";  
	break;  
	
	case 3:  
	$suffix = "rd";  
	break;  
	
	default:  
	$suffix = "th";  
	break;  
	}  
	
	endif;  
	
	return "${number}<SUP>$suffix</SUP>";  
	
	} 