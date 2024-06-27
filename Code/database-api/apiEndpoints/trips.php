<?php
/**
 * @file vehicules.php
 * File containing any and all api request functions pertaining to the vehicules table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";


/**
 * Create a trip with an api call and returns the trip details
 * @param   string from : Departure location
 * @param   string to: Arrival location
 * @param   string hour_depart: Departure time
 * @param   string hour_arrival: Arrival time
 * @param   string direction : Lens ou Villeneuve
 * @param  string date: Date of the trip in the format 'Y-m-d H:i:s'
 * @param  string description: Description of the trip
 * @param  string hash: Hash of the user
 * @param  int conversation_id: Id of the conversation (IMPORTANT)
 * 
 * @return  object response: {status,apiname, sucess: true/false, trip: {trip-id, vehicle-id, conversation-id, from, to, hour_depart, hour_arrival, direction, places, date, description, conductor-name}
**/
registerEndpoint("POST_trip/register",'registerTrip');


/**
 * Returns a list of all trips
 * @return array&object trips: [{trip-id, vehicle-id, conversation-id, from, to, hour_depart, hour_arrival, direction, places, date, description, conductor-name}]
**/
registerEndpoint("GET_trip/list",'getTripList');


registerEndpoint("GET_trip/user-created",'getTripsCreatedByUser');


function registerTrip(){
    $from         = validate("from", "REQUEST");
    $to           = validate("to", "REQUEST");
    $hour_depart  = validate("hour_depart", "REQUEST");
    $hour_arrival = validate("hour_arrival", "REQUEST");
    $direction    = validate("direction", "REQUEST");
    $date         = validate("date", "REQUEST");
    $description  = validate("description", "REQUEST");
    $hash         = validate("hash", "REQUEST");
    $conversation_id = validate("conversation_id", "REQUEST");
    
    if (!($from and $to and $hour_depart and $hour_arrival and $direction and $date and $description and $hash and $conversation_id)){
        $response = RESP_BAD_REQUEST;
        $response["message"] = "Missing parameters";
        apiSendResp($response);
        return;
    }
    $idName = hashToIdName($hash);
    $userName = $idName["name"];
    $datetime = new DateTime($date);
    $formattedDate = $datetime->format("Y-m-d H:i:s");
    $conversation_id = intval($conversation_id);

    $vehicle = getVehiculeData($hash);
    $vehicle_id = $vehicle["id"];
    $places = $vehicle["max_places"];

    if ($vehicle_id and $userName){
        $SQL = "INSERT INTO `Trip` VALUES (NULL,'{$vehicle_id}','{$conversation_id}','{$from}','{$to}','{$hour_depart}','{$hour_arrival}','{$direction}','{$places}','{$formattedDate}','{$description}','{$userName}');";
        try{
            $trip_id = SQLInsert($SQL);
            $response = RESP_OK;
            $response['trip'] = ["trip-id"=> $trip_id, "vehicle-id"=>$vehicle_id, "conversation-id"=>$conversation_id, "from"=>$from, "to"=>$to, "hour_depart"=>$hour_depart, "hour_arrival"=>$hour_arrival, "direction"=>$direction, "places"=>$places, "date"=>$formattedDate, "description"=>$description, "conductor-name"=>$userName];
            apiSendResp($response);

        }catch(Exception $e){
            $response = RESP_BAD_REQUEST;
            $response["message"] = $e->getMessage();
            apiSendResp($response);
        }

    } else{
        $response = RESP_BAD_REQUEST;
        $response["message"] = "No vehicle id or user name found.";
        apiSendResp($response);
        
    }
}

function getTripList(){
    $SQL = "SELECT * FROM `Trip`;";
    try{
        $response = RESP_OK;
        $response['trips'] = parcoursRs(SQLSelect($SQL));
        apiSendResp($response);
    }catch(Exception $e){
        $response = RESP_BAD_REQUEST;
        $response["message"] = $e->getMessage();
    }
}


function getTripsCreatedByUser(){
    if($hash = validate("hash", "REQUEST")){
        $vehicule = getVehiculeData($hash);
        $idVehicule = $vehicule["id"];
        $SQL = "SELECT * FROM `Trip` WHERE `vehicle_id`='{$idVehicule}';";
        try{
            $response = RESP_OK;
            $response['trips'] = parcoursRs(SQLSelect($SQL));
            apiSendResp($response);
        }catch(Exception $e){
            $response = RESP_BAD_REQUEST;
            $response["message"] = $e->getMessage();
            apiSendResp($response);
        }
    }else{
        $response = RESP_BAD_REQUEST;
        $response["message"] = "Missing hash";
        apiSendResp($response);
    }

}


# Util
function hashToIdName($hash){
    $hash = protect($hash);	

	$SQL = "SELECT `id`,`name` FROM `Account` WHERE hash='{$hash}'";
    $response = parcoursRs(SQLSelect($SQL));
    return $response[0];
}

?>