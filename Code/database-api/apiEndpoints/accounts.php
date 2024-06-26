<?php
/**
 * @file accounts.php
 * File containing any and all api request functions pertaining to the accountns table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

//Endpoints
/**
 * Create a user with an api call and returns the hash of the new user
 * It cannot create admin users
 * @param   string name
 * @param   string password
 * @param   string mail
 * @param   string description
 * @param   string job
 * @return  string hash
**/
registerEndpoint("POST_create-user",'createUser');
/**
 * Checks if a user password pair is a valid user in the database
 * If there is a user, the call returns the hash
 * Otherwise, it fails with a RESP_UNAUTHORIZED 
 * @param   string user
 * @param   string password
 * @return  string hash
**/
registerEndpoint("POST_authenticate",'authenticate'); 

/**
 * Returns the text based information about the given user
 * @param   string hash
 * @return  string name
 * @return  string mail
 * @return  string job 
**/
registerEndpoint("GET_user-info/text",'getUserInfo');

/**
 * Returns the profile picture of the given user
 * @param   string hash
 * @return  string prorfile-picture 
**/
registerEndpoint("GET_user-info/profile-picture",'getUserProfilePicture');

registerEndpoint("POST_user-info/update",'updateUserInfo');
registerEndpoint("POST_user-info/delete",'deleteUser');

// Enpoint Handlers
/**
 * Creates a user with the parameters in the rquest
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
	$SQL = "INSERT INTO `Account` VALUES (NULL,'{$name}', '{$hash}', '{$mail}', '{$description}', '{$job}', NULL, '0');";

	SQLInsert($SQL);

	
	$result = RESP_OK;
	$result["hash"] = $hash;
	apiSendResp($result);
}

/**
 * Validates wheather or not a $user $password pair (given in the request) is a valid user in the database. If so, it returns the hash of the
 * specified user and false otherwise
**/
function authenticate(){
	$name       = validate("name"       , "REQUEST");
	$password   = validate("password"   , "REQUEST");
	if(!($name and $password)) apiSendResp(RESP_BAD_REQUEST);


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
	if(!$hash) apiSendResp(RESP_BAD_REQUEST);

	$SQL = "SELECT `name`,`mail`,`description`,`job`  FROM `Account` WHERE hash='{$hash}';";
	$userInfo = parcoursRs(SQLSelect($SQL));	

	$result = RESP_OK;
	$result["userInfo"] = $userInfo;
	apiSendResp($result);
}

function getUserProfilePicture(){
	$hash       = validate("hash"       , "REQUEST");
	if(!$hash) apiSendResp(RESP_BAD_REQUEST);

	$SQL = "SELECT `profile_picture` FROM `Account` WHERE hash='{$hash}';";
	$userInfo = parcoursRs(SQLSelect($SQL));	

	$result = RESP_OK;
	$result["userInfo"] = $userInfo;
	apiSendResp($result);
}

function updateUserInfo(){
	$hash       = validate("hash"   , "REQUEST");
	$update     = str_replace("\\", "",validate("data"   , "REQUEST")); //@todo: find a better way to do this

	if(!($hash and  $update)) apiSendResp(RESP_BAD_REQUEST);
	if(!(gettype($update) == "array")) apiSendResp(RESP_BAD_REQUEST);

	$result = RESP_OK;
	$result["hash"] = $hash;

	$SQL = "UPDATE `Account` SET";
	foreach($update as $property=>$new_value){
		if($property == "password"){
		       	$SQL .= "`hash` = '".password_hash($new_value, PASSWORD_DEFAULT)."' ";
			$result["hash"] = $hash;
		}
		else $SQL .= "`{$property}` = '{$new_value}' ";

		if($property != array_key_last($update)) $SQL.=",";

	}

	$SQL.= "WHERE `hash` = '{$hash}'";	
	SQLUpdate($SQL);	

	apiSendResp($result);
}

function deleteUser(){
	$hash       = validate("hash"   , "REQUEST");
	if(!$hash) apiSendResp(RESP_BAD_REQUEST);
	
	$SQL = "DELETE FROM `Account` WHERE `hash`='{$hash}';"; 
	SQLDelete($SQL);

	apiSendResp(RESP_OK);
}
?>
