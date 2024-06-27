<?php
/**
 * @file conversations_aux.php
 * File containing any and all api request functions pertaining to the Conversation_Accounts_AUX table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

//Endpoints
/**
 * Create a conversation
 * @param   string hash
 * @param   int conversation id
 * @return  object 
**/
registerEndpoint("POST_conversation_aux/register",'registerConversationAux');


/**
 * Returns a list of associated conversations with the given user
 * 
 * @param   string hash
 * @return  int id_conversations
**/
registerEndpoint('GET_conversation_aux/info','getConversationAuxInfo');


/**
 * Delete vehicleconversation associated with the user
 * @param   string hash
 * @return  object&int conversation: {id})
**/
registerEndpoint('DELETE_conversation_aux/delete','deleteConversationAux');

function registerConversationAux(){

    $headers = getallheaders();
    
    # Check if hash is present in headers
    if (isset($headers['hash'])) {
        $hash = $headers['hash'];
    } else {
        $hash = NULL; # TODO: Make it more secure.
    }
    
    if ($hash){
        $conversationOwner = hashToId($hash);
    } else {
        $conversationOwner = NULL;
    }

    $conversation_id = validate("conversation_id", "REQUEST");

    if(!($conversationOwner and $conversation_id)) {
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }

    $conversation_id = protect($conversation_id);

    $SQL = "INSERT INTO `Conversation_Accounts_AUX` VALUES ('{$conversationOwner}', '{$conversation_id}');";

    $rowid = SQLInsert($SQL);
    $result = RESP_OK;
    $result['conversations_aux'] = ["accountId" => $conversationOwner, "conversationId" => $conversation_id, "rowId" => $rowid];
    apiSendResp($result);
}

function getConversationAuxInfo() {
    $hash = validate("hash", "REQUEST");
    if (!($hash)){
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }

    $conversationOwner = hashToId($hash);
    $SQL = "SELECT 'conversation_id' FROM 'Conversation_Accounts_AUX' WHERE account_id='{$conversationOwner}';";
    $result = RESP_OK;
    $result["conversations_aux"] = parcoursRs(SQLSelect($SQL));
    $result["id"] = $conversationOwner;
    apiSendResp($result);
}

function deleteConversationAux() {
    if (!(validate("hash", "REQUEST") and validate("conversation_id", "REQUEST"))){
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }

    $hash = validate("hash", "REQUEST");
    $conversation_id = validate("conversation_id", "REQUEST");
    $user_id = hashToId($hash);

    try {
        $SQL = "SELECT * FROM 'Conversation_Accounts_AUX' WHERE 'conversation_id'='{$conversation_id}' AND 'account_id'='{$user_id}';";
        $selectResult = parcoursRs(SQLSelect($SQL));
        if ($selectResult) {
            $SQL = "DELETE FROM 'Conversation_Accounts_AUX' WHERE 'conversation_id'='{$conversation_id}' AND 'account_id'='{$user_id}';";
            if (SQLDelete($SQL)) {
                $result = RESP_OK;
                $result["conversations_aux"] = $conversation_id;
                apiSendResp($result);
            }
            else {
                $reponse = RESP_BAD_REQUEST;
                $reponse["message"] = "Conversation not found or you are not the owner of this conversation";
                apiSendResp($reponse);
            }
        }
        else {
            $reponse = RESP_BAD_REQUEST;
            $reponse["message"] = "Conversation not found or you are not the owner of this conversation";
            apiSendResp($reponse);
        }
    } 
    catch (Exception $e) {
        $reponse = RESP_INTERNAL_ERROR;
        $reponse["message"] = $e->getMessage();
        apiSendResp($reponse);
    }
}

?>