<?php
/**
 * @file accounts.php
 * File containing any and all api request functions pertaining to the accountns table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";
registerSubdomain("POST_create-user", function(){

	$name       = validate("name"       , "REQUEST");
	$password   = validate("password"   , "REQUEST");
	$mail       = validate("mail"       , "REQUEST");
	$description= validate("description", "REQUEST");
	$job        = validate("job"        , "REQUEST");

	if(!($name and $password and $mail and $description and $job)) apiSendResp(RESP_BAD_REQUEST);

	$result = RESP_OK;
	$result["hash"] = createUser($name,$password,$mail,$description,$job);
	apiSendResp($result);
});

/**
 * Creates a user with the given parameters
 * @param   string $user
 * @param   string $password
 * @return  string hash for the user that was just created 
**/
function createUser($name, $password, $mail,$description, $job){

	$hash = password_hash($password, PASSWORD_DEFAULT);
	$SQL = "INSERT INTO `Account` (`id`, `name`, `hash`, `mail`, `description`, `job`, `admin`) VALUES (NULL,'{$name}', '{$hash}', '{$mail}', '{$description}', '{$job}', '0');";

	SQLInsert($SQL);

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
