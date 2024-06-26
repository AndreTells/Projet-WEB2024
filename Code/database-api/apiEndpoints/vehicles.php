<?php
/**
 * @file vehicules.php
 * File containing any and all api request functions pertaining to the vehicules table in the database
**/

include_once "utils.php";
include_once "sqlUtils/sqlFunctions.pdo.php";

registerEndpoint("POST_vehicle/register",'registerVehicle');

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
        $SQL = "INSERT INTO `Vehicle` VALUES (NULL, '{$vehicleOwner}','{$model}', '{$license_plate}', '{$max_places}');";
    } else {
        $SQL = "INSERT INTO `Vehicle` VALUES (NULL, NULL,'{$model}', '{$license_plate}', '{$max_places}');";
    }
    

    SQLInsert($SQL);
    $result = RESP_OK;
    apiSendResp($result);
}


?>