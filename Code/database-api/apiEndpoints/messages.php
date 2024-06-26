<?php
/**
 * @file messages.php
 * File containing any and all api request functions  pertaining to the messages accounts tableu in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

//Endpoints
registerEndpoint("POST_send-message",'sendMessage');

// Endpoint Handlers
function sendMessage(){	
	$hash       = validate("hash"       , "REQUEST");
	$conv_id    = validate("conv_id"    , "REQUEST");
	$content    = validate("content"    , "REQUEST");

	if(!($hash and $conv_id and $content)) apiSendResp(RESP_BAD_REQUEST);

	$user_id    = hashToId($hash);			
	
	$SQL = "INSERT INTO `Message` VALUES ('{$conv_id}', '{$user_id}', '".date('Y-m-d H:i:s')."', '{$content}');";	
	try {
	
		SQLInsert($SQL);
	}
	catch(Exception $e){
		$result = RESP_INTERNAL_ERROR;
		$resut["message"] = $e->getMessage();
		apiSendResp(RESP_INTERNAL_ERROR);
	}

	$resut = RESP_OK;
	apiSendResp($resut);
}
?>
