<?php
/**
 * @file api.php
 * Re-route api requests to the appropriate files safely
**/

include_once "utils.php";
include_once "constants.php";
include_once "crudOperations/accounts.php";

// @todo: move files that aren't public to outside public directory (?)
session_start();
$apiUri = validate("REQUEST_URI", "SERVER");

if(!$apiUri) apiSendResp(RESP_INTERNAL_ERROR);

$apiRequest = explode('/',explode('?',str_replace(API_ROOT, "",$apiUri))[0]);

switch($apiRequest[0]){
	case 'api-test':
		$response = RESP_OK;
		$response["content"] = "test";
		apiSendResp($response);
		break;

	case '':
	case 'authenticate':
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
