<?php
/**
 * @file accounts.php
 * File containing any and all api request functions pertaining to the accountns table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

registerEndpoint("POST_create-user",'createUser');
registerEndpoint("POST_authenticate",'authenticate'); 


// Subdomain Handlers
/**
 * Creates a user with the given parameters
 * @param   string $user
 * @param   string $password
 * @return  string hash for the user that was just created 
**/
function createUser(){
	$name       = validate("name"       , "REQUEST");
	$password   = validate("password"   , "REQUEST");
	$mail       = validate("mail"       , "REQUEST");
	$description= validate("description", "REQUEST");
	$job        = validate("job"        , "REQUEST");

	if(!($name and $password and $mail and $description and $job)) apiSendResp(RESP_BAD_REQUEST);

	
	$name        = protect($name);
	$password    = protect($password);
	$mail        = protect($mail);
	$description = protect($description);
	$job         = protect($job);


	$hash = password_hash($password, PASSWORD_DEFAULT);
	$SQL = "INSERT INTO `Account` VALUES (NULL,'{$name}', '{$hash}', '{$mail}', '{$description}', '{$job}', '0');";

	SQLInsert($SQL);

	
	$result = RESP_OK;
	$result["hash"] = $hash;
	apiSendResp($result);
}

/**
 * Validates wheather or not a $user $password pair is a valid user in the database. If so, it returns the hash of the
 * specified user and false otherwise
**/
function authenticate(){
	$name       = validate("name"       , "REQUEST");
	$password   = validate("password"   , "REQUEST");
	if(!($name and $password)) apiSendResp(RESP_BAD_REQUEST);

	$name = protect($name);
	$password = protect($password);

	$SQL = "SELECT hash FROM `Account` WHERE name='{$name}'";
	$hash = SQLGetChamp($SQL);

	if(!$hash) apiSendResp(RESP_UNAUTHORIZED);

	if(!password_verify($password, $hash)) apiSendResp(RESP_UNAUTHORIZED);

	$result = RESP_OK;
	$result["hash"] = $hash;

	apiSendResp($result);
}

function getUserInfo(){
	$hash       = validate("hash"       , "REQUEST");

	$SQL = "SELECT * FROM `Account` WHERE hash='{$hash}'";
	$userInfo = parcoursRs(SQLSelect($SQL));	

	$result = RESP_OK;
	$result["userInfo"] = $userInfo;
	apiSendResp($result);
}

// helper function related to accounts

/**
 * returns the id of the user with the given hash
 * @param string $hash
 * @return int 
**/
function hashToId($hash){
	$hash = protect($hash);	

	$SQL = "SELECT 'id' FROM `Account` WHERE hash='{$hash}'";
	$id = intval(SQLGetChamp($SQL)); 

	return $id;
} 



?>
