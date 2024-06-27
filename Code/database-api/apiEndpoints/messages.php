<?php
/**
 * @file messages.php
 * File containing any and all api request functions  pertaining to the messages accounts tableu in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

//Endpoints
/**
 * Sends a message in a given conversation with the current time
 * @param $hash
 * @param $conv_id
 * @param $content
**/
registerEndpoint("POST_send-message",'sendMessage');


registerEndpoint("GET_messages",'getMessages');

// Endpoint Handlers
/**
 * Sends a message with the current time
**/
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



function getMessages(){
	if ($conversation_id = validate("conversation_id", "REQUEST")){

		try{
		$SQL = "SELECT `post_time`, `content`, `posting_account_id`, `name` 
        FROM `Message` 
        INNER JOIN `Account` 
        ON `Message`.`posting_account_id` = `Account`.`id` 
        WHERE `Message`.`conversation_id` = '{$conversation_id}';";

		$result = RESP_OK;
		$result["messages"] = parcoursRs(SQLSelect($SQL));
		apiSendResp($result);
		}
		catch(Exception $e){
			$result = RESP_INTERNAL_ERROR;
			$result["message"] = $e->getMessage();
			apiSendResp($result);
		}
	}
	else
	{
		$result = RESP_BAD_REQUEST;
		$result["message"] = "missing conversation_id";
		apiSendResp(RESP_BAD_REQUEST);
	}
}

?>
