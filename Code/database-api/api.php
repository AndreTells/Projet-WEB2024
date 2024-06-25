<?php
/**
 * @file api.php
 * Re-route api requests to the appropriate files safely
**/

include_once "utils.php";
include_once "constants.php";

// TODO: move files that aren't public to outside public directory (?)
// TODO: check if creating a session is necessary
// session_start();
$apiUri = validate("REQUEST_URI", "SERVER");

if(!$apiUri) apiSendResp(RESP_INTERNAL_ERROR);

$apiRequest = explode('/',explode('?',str_replace(API_ROOT, "",$apiUri))[0]);

switch($apiRequest[0]){
	case 'api-test':
		$response = RESP_OK;
		$response["content"] = "test";
		apiSendResp($response);
		break;
	default:
		apiSendResp(RESP_NOT_IMPLEMENTED);
		break;
}
die("");
?>
