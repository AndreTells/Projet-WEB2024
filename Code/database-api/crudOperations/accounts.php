<?php

/**
 * @file accounts.php
 * File containing any and all api request functions pertaining to the accountns table in the database
**/


/**
 * Creates a user with the given parameters
 * @param   string $user
 * @param   string $password
 * @return  string hash for the user that was just created 
**/
function createUser($user, $password){
	$_SESSION["idUser"] = 0; // @todo: use what's returned from sql function
	$hash =  password_hash($password, PASSWORD_DEFAULT);
	return $hash;
}

/**
 * Validates wheather or not a $user $password pair is a valid user in the database. If so, it returns the hash of the
 * specified user and false otherwise
**/
function authenticate($user, $password){
	//check if database contains user where name = $user & hash = password_hash($password, PASSWORD_DEFAULT)
	//$hash = ...
	//if(password_verify($password, $user))
	//	save user to session
	//	return hash
		return "aaaaaaaaaaaaa";
	return false;
}

?>
