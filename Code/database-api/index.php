<?php
/**
 * @file api.php
 * Re-route api requests to the appropriate files safely
**/

include_once "utils.php";
include_once "constants.php";
include_once "crudOperations/accounts.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

// @todo: move files that aren't public to outside public directory (?)
session_start();

// parsin the request url
$apiRequest = validate("request"        , "REQUEST"); 
$method     = validate("REQUEST_METHOD" , "SERVER" );
if(!($apiRequest and $method)) apiSendResp(RESP_BAD_REQUEST);

$apiStr = $method . "_" . $apiRequest; 

// routing to appropriate function
switch($apiStr){
	case 'GET_api-test':
		$response = RESP_OK;
		$response["content"] = "test";
		apiSendResp($response);
		break;

	case 'POST_authenticate':
		$user = validate("user","POST");
		$password = validate("password", "POST");
		if(!($user and $password)) apiSendResp(RESP_BAD_REQUEST);

		$hash = authenticate($user,$password);
		if(!$hash) apiSendResp(RESP_BAD_REQUEST);

		$response = RESP_OK;
		$response["hash"] = $hash;
		apiSendResp($response);
		break;
	default:
		apiSendResp(RESP_NOT_IMPLEMENTED);
		break;
}

apiSendResp(RESP_INTERNAL_ERROR);
die("");
?>
