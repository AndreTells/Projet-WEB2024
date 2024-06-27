<?php
/**
 * @file conversations.php
 * File containing any and all api request functions pertaining to the Conversations table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

//Endpoints
/**
 * Create a conversation
 * @param   int id
 * @param   string title
 * @return  array&object conversation: [{id, title}]

**/
registerEndpoint("POST_conversation/register",'registerConversation');


/**
 * Returns a list of associated conversations with the given user
 * @param   int id
 * @return  string title
**/
registerEndpoint('GET_conversation/info','getConversation');

/**
 * Delete conversation associated with the user
 * @param   int id
 * @param   string title
 * @return  object&int conversation: {id})
**/
registerEndpoint('DELETE_conversation/delete','deleteConversation');

function registerConversation() {

    $title = validate("title", "REQUEST");
    if (!$title) {
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }
    $title = protect($title);

    $SQL = "INSERT INTO 'Conversation' VALUES (NULL, '{$title}');";
    $rowid = SQLInsert($SQL);

    $result = RESP_OK;

    $result['conversation'] = ["id" => $rowid, "title" => $title];
    apiSendResp($result);
}

function getConversation() {
    $id = validate("id", "REQUEST");
    if (!($id)) {
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }

    $SQL = "SELECT 'title' FROM 'Conversation' WHERE id='{$id}';";
    $result = RESP_OK;
    $result["id"] = parcoursRs(SQLSelect($SQL));
    apiSendResp($result);
}

function deleteConversation() {
    $conversation_id = validate("id", "REQUEST");
    $title = validate("title", "REQUEST");

    try {
        $SQL = "SELECT * FROM `Conversation` WHERE `title`='{$title}' AND `id`='{$conversation_id}';";
        $selectResult = parcoursRs(SQLSelect($SQL));
        if ($selectResult){
            $SQL = "DELETE FROM `Conversation` WHERE `title`='{$title}' AND `id`='{$conversation_id}';";
            if (SQLDelete($SQL)){
                $result = RESP_OK;
                $result["conversation"] = $conversation_id;
                apiSendResp($result);
            }else{
                $response = RESP_BAD_REQUEST;
                $reponse["message"] = "Conversation not found or you are not the owner of this conversation";
                apiSendResp($response);
            }
            
        }
        else{
            $response = RESP_BAD_REQUEST;
            $reponse["message"] = "Conversation not found or you are not the owner of this conversation";
            apiSendResp($response);
        }

    }catch(Exception $e){
        $response = RESP_INTERNAL_ERROR;
        $response['message'] = $e->getMessage();
        apiSendResp($response);
    }

}

?>