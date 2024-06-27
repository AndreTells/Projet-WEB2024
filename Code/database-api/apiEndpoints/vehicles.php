<?php
/**
 * @file vehicules.php
 * File containing any and all api request functions pertaining to the vehicules table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";


//Endpoints
/**
 * Create a user with an api call and returns the hash of the new user
 * It cannot create admin users
 * @param   string|null HEADER parameter
 * @param   string model
 * @param   string license_plate
 * @param   string max_places
 * @param   string image
 * @return  object response: {status,apiname, sucess: true/false, vehicule: {model,license_plate,max_places}
**/
registerEndpoint("POST_vehicle/register",'registerVehicle');


/**
 * Returns a list of associated vehicles with the given user
 * 
 * @param   string hash
 * @return  array&object vehicles: [{model,license_plate,max_places}]
**/
registerEndpoint('GET_vehicle/info','getUserVehiclesInfo');

/**
 * Returns a list of vehicles associated with the institution
 * 
 * @param   string hash
 * @return  array&object vehicles: [{id,model,license_plate,max_places}]
**/
registerEndpoint('GET_vehicle/institution','listInsitutitionVehicles');


/**
 * Delete vehicle associated with the user
 * Removes only if the user is the owner of the vehicle
 * @param   string hash
 * @return  object&int vehicle: {id})
**/
registerEndpoint('DELETE_vehicle/delete','deleteVehicle');

# CREATE
function registerVehicle(){
    # If the user is not authenticated, the hash is set to NULL. This is done to handle the cases of centrale's own vehicles.
    
    $headers = getallheaders();
    
    # Check if hash is present in headers
    if (isset($headers['hash'])) {
        $hash = $headers['hash'];
    } else {
        $hash = NULL; # TODO: Make it more secure.
    }
    $model         = validate("model"      , "REQUEST");
    $license_plate = validate("license_plate", "REQUEST");
    $max_places    = validate("max_places"   , "REQUEST");
    if (validate("image", "REQUEST")){
        $image = validate("image", "REQUEST");
    } else {
        $image = NULL;
    }

    if(!($model and $license_plate and $max_places)){apiSendResp(RESP_BAD_REQUEST);
    return;
    }

    if ($hash){
        $vehicleOwner = hashToId($hash);
    } else {
        $vehicleOwner = NULL;
    }
    $model         = protect($model);
    $license_plate = protect($license_plate);
    $max_places    = protect($max_places);

    if ($vehicleOwner){
        $SQL = "INSERT INTO `Vehicle` VALUES (NULL, '{$vehicleOwner}','{$model}', '{$license_plate}', '{$max_places}', '{$image}');";
    } else {
        $SQL = "INSERT INTO `Vehicle` VALUES (NULL, NULL,'{$model}', '{$license_plate}', '{$max_places}');";
    }

    SQLInsert($SQL);
    $result = RESP_OK;
    $result['vehicule'] = ["model" => $model, "license_plate" => $license_plate, "max_places" => $max_places];
    apiSendResp($result);
}



function getUserVehiclesInfo(){
    $hash = validate("hash", "REQUEST");
    if (!($hash)){
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }
    $vehicleOwner = hashToId($hash);
    $SQL = "SELECT `id`,`model`,`license_plate`,`max_places`,`image` FROM `Vehicle` WHERE conductor_id='{$vehicleOwner}';";
    $result = RESP_OK;
    $result["vehicles"] = parcoursRs(SQLSelect($SQL));
    $result["id-owner"] = $vehicleOwner;
    apiSendResp($result);

}

function listInsitutitionVehicles(){
    $hash = validate("hash", "REQUEST");
    if (!($hash)){
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }
    $SQL = "SELECT `id`,`model`,`license_plate`,`max_places`,`image` FROM `Vehicle` WHERE conductor_id IS NULL;";
    $result = RESP_OK;
    $result["vehicle"] = parcoursRs(SQLSelect($SQL));
    apiSendResp($result);
}


function deleteVehicle(){
    if (!(validate("hash", "REQUEST") and validate("id", "REQUEST"))){
        apiSendResp(RESP_BAD_REQUEST);
        return;
    }
    $hash = validate("hash", "REQUEST");
    $vehicle_id = validate("id", "REQUEST");
    $user_id = hashToId($hash);
    try{
        $SQL = "SELECT * FROM `Vehicle` WHERE `id`='{$vehicle_id}' AND `conductor_id`='{$user_id}';";
        $selectResult = parcoursRs(SQLSelect($SQL));
        if ($selectResult){
            $SQL = "DELETE FROM `Vehicle` WHERE `id`='{$vehicle_id}' AND `conductor_id`='{$user_id}';";
            if (SQLDelete($SQL)){
                $result = RESP_OK;
                $result["vehicles"] = $vehicle_id;
                apiSendResp($result);
            }else{
                $response = RESP_BAD_REQUEST;
                $response['message'] = "Vehicle not found or you are not the owner of the vehicle";
                apiSendResp($response);
            }
            
        }else{
            $response = RESP_BAD_REQUEST;
            $response['message'] = "Vehicle not found or you are not the owner of the vehicle";
            apiSendResp($response);
        }

    }catch(Exception $e){
        $response = RESP_INTERNAL_ERROR;
        $response['message'] = $e->getMessage();
        apiSendResp($response);
    }

}

?>
