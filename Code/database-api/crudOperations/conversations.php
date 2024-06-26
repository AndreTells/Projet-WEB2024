<?php

/**
 * @file conversation.php
 * File containing any and all api request functions pertaining to the conversation table in the database
**/

/**
 * Creates a new conversation with the given title.
 * 
 * @param string $title 
 * @return bool
 */
function createConversation($title) {
  $accountId = $_SESSION["idUser"];
  
  $sql = "INSERT INTO Conversation (title) VALUES ('$title')";
  $lastId = SQLInsert($sql);
  
  if ($lastId) {
      $sql = "INSERT INTO Conversation_Accounts_AUX (account_id, conversation_id) VALUES ($accountId, $lastId)";
  }
  return SQLInsert($sql);
}

/**
 * Retrieves a conversation by its ID, including associated messages
 * 
 * @param int $conversationId
 * @return mixed
 */
function getConversation($conversationId) {
  $sql = "SELECT Conversation.id AS conversation_id, Conversation.title AS conversation_title, 
          Message.id AS message_id, Message.content AS message_content FROM Conversation 
          LEFT JOIN Message ON Conversation.id = Message.conversation_id
          WHERE Conversation.id = $conversationId";
  $result = SQLSelect($sql);

  if ($result) {
      return parcoursRs($result);
  }
  return false;
}

/**
 * Updates the title of an existing conversation.
 * 
 * @param int $conversationId
 * @param string $newTitle
 * @return bool
 */
function updateConversation($conversationId, $newTitle) {
  $sql = "UPDATE Conversation SET title = '$newTitle' WHERE id = $conversationId";
  return SQLUpdate($sql);
}

/**
 * Deletes a conversation by its ID.
 * 
 * @param int $conversationId
 * @return bool
 */
function deleteConversation($conversationId) {
  $sql = "DELETE FROM Message WHERE conversation_id = $conversationId";
  SQLDelete($sql);
  $sql = "DELETE FROM Conversation WHERE id = $conversationId";
  return SQLDelete($sql);
}

?>
