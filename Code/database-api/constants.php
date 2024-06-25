<?php
/**
 * Variable containing the nanme of the current api 
 * @var string 
**/
const API_NAME = "DataBaseApi-ProjectWEB2024";

/**
 * Constants containing an array with a base to be used for the given type of response
 * @var array
**/
//Successful responses
const RESP_OK                = array("status"=>200, "apiname"=>API_NAME, "success"=> true  ); 

//Client Error Responses
const RESP_BAD_REQUEST       = array("status"=>400, "apiname"=>API_NAME, "success"=> false ); 
const RESP_UNAUTHORIZED      = array("status"=>401, "apiname"=>API_NAME, "success"=> false ); 

//Server Error Responses
const RESP_INTERNAL_ERROR    = array("status"=>500, "apiname"=>API_NAME, "success"=> false );
const RESP_NOT_IMPLEMENTED   = array("status"=>501, "apiname"=>API_NAME, "success"=> false ); 
const RESP_NOT_EXTENDED      = array("status"=>510, "apiname"=>API_NAME, "success"=> false ); 

?>
