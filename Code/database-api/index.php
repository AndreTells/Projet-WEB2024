<?php
/**
 * @file api.php
 * Re-route api requests to the appropriate files safely
**/

//register apicalls
$registredPaths = array();
$pathHandler    = array();

include_once "utils.php";
include_once "constants.php";
include_once "apiEndpoints/accounts.php";
include_once "apiEndpoints/vehicles.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");


// example of how to register a new subdomain list
registerEndpointList(["POST_test","GET_test"], function() {apiSendResp(RESP_OK);});


// @todo: move files that aren't public to outside public directory (?)
session_start();

// parsin the request url
$apiRequest = validate("request"        , "REQUEST"); 
$method     = validate("REQUEST_METHOD" , "SERVER" );
if(!($apiRequest and $method)) apiSendResp(RESP_BAD_REQUEST);

$apiStr = $method . "_" . $apiRequest; 

// routing to appropriate function
switch($apiStr){
	case (bool)preg_match("/^(".str_replace("/","\/",getRegisterPathsRegex()).")/", $apiStr):
		executeHandler($apiStr);
		break;
	default:
		apiSendResp(RESP_NOT_IMPLEMENTED);
		break;
}

apiSendResp(RESP_INTERNAL_ERROR);
?>
