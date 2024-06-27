<?php
/**
 * @file vehicules.php
 * File containing any and all api request functions pertaining to the vehicules table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";


registerEndpoint("POST_feedback",'sendFeedback');

function sendFeedback(){
    $prenom     = validate("prenom", "REQUEST");
    $nom        = validate("nom", "REQUEST");
    $email      = validate("email", "REQUEST");
    $message    = validate("message", "REQUEST");

    if (!($prenom and $nom and $email and $message)){
        $response = RESP_BAD_REQUEST;
        $response["message"] = "Missing prenom or nom or email or message";
        apiSendResp($response);
        return;
    }else{
        $SQL = "INSERT INTO `Feedback` VALUES (NULL, '{$prenom}', '{$nom}', '{$email}', '{$message}');";
        try {
            SQLInsert($SQL);
            $response = RESP_OK;
            $response["message"] = "Feedback sent";
            apiSendResp($response);
        }
        catch(Exception $e){
            $response = RESP_INTERNAL_ERROR;
            $response["message"] = $e->getMessage();
            apiSendResp($response);
        }
    
    }
    

}

?>