<?php


function createUser($user, $password){
	// check if database contains user where name = $user & hash = password_hash($password, PASSWORD_DEFAULT)
	$hash =  password_hash($password, PASSWORD_DEFAULT);
}

function authenticate($user, $password){
	//$hash = ...
	//if(password_verify($password, $user))
	//	save user to session
	//	return hash
		return "aaaaaaaaaaaaa";
	return false;
}

?>
