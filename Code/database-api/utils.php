<?php
include_once "constants.php";
// V1.0 du 18 mai 2018
// mostly a copy from the file maLibUtils.php provided during the course

/**
 * @file utils.php
 * Ce fichier définit des fonctions d'accès ou d'affichage pour les tableaux superglobaux
 */

/**
 * Vérifie l'existence (isset) et la taille (non vide) d'un paramètre dans un des tableaux GET, POST, COOKIES, SESSION
 * Renvoie false si le paramètre est vide ou absent
 * @note l'utilisation de empty est critique : 0 est empty !!
 * Lorsque l'on teste, il faut tester avec un ===
 * @param string $nom
 * @param string $type
 * @return string|boolean
 */
function validate($nom,$type="REQUEST")
{	
	switch($type)
	{
		case 'REQUEST': 
		if(isset($_REQUEST[$nom]) && !($_REQUEST[$nom] == "")) 	
			return protect($_REQUEST[$nom]); 	
		break;
		case 'GET': 	
		if(isset($_GET[$nom]) && !($_GET[$nom] == "")) 			
			return protect($_GET[$nom]); 
		break;
		case 'POST': 	
		if(isset($_POST[$nom]) && !($_POST[$nom] == "")) 	
			return protect($_POST[$nom]); 		
		break;
		case 'COOKIE': 	
		if(isset($_COOKIE[$nom]) && !($_COOKIE[$nom] == "")) 	
			return protect($_COOKIE[$nom]);	
		break;
		case 'SESSION': 
		if(isset($_SESSION[$nom]) && !($_SESSION[$nom] == "")) 	
			return $_SESSION[$nom]; 		
		break;
		case 'SERVER': 
		if(isset($_SERVER[$nom]) && !($_SERVER[$nom] == "")) 	
			return $_SERVER[$nom]; 		
		break;
	}
	return false; // Si pb pour récupérer la valeur 
}


/**
 * Vérifie l'existence (isset) et la taille (non vide) d'un paramètre dans un des tableaux GET, POST, COOKIE, SESSION
 * Prend un argument définissant la valeur renvoyée en cas d'absence de l'argument dans le tableau considéré

 * @param string $nom
 * @param string $defaut
 * @param string $type
 * @return string
*/
function getValue($nom,$defaut=false,$type="REQUEST")
{
	// NB : cette commande affecte la variable resultat une ou deux fois
	if (($resultat = valider($nom,$type)) === false)
		$resultat = $defaut;

	return $resultat;
}

/**
*
* Evite les injections SQL en protegeant les apostrophes par des '\'
* Attention : SQL server utilise des doubles apostrophes au lieu de \'
* ATTENTION : LA PROTECTION N'EST EFFECTIVE QUE SI ON ENCADRE TOUS LES ARGUMENTS PAR DES APOSTROPHES
* Y COMPRIS LES ARGUMENTS ENTIERS !!
* @param string $str
*/
function protect($str)
{
	// attention au cas des select multiples !
	// On pourrait passer le tableau par référence et éviter la création d'un tableau auxiliaire
	if (is_array($str))
	{
		$nextTab = array();
		foreach($str as $cle => $val)
		{
			$nextTab[$cle] = addslashes($val);
		}
		return $nextTab;
	}
	else 	
		return addslashes ($str);
	//return str_replace("'","''",$str); 	//utile pour les serveurs de bdd Crosoft
}

/**
 * Encapsulates the process of sending the api Responses to the users and ends the server side process
 * @param array $response array containing the response data and uses one of the 'RESP_...' constants defined as a base
 * @see   constants.php file
**/
function apiSendResp($response){
	echo json_encode($response);	
	die("");
}

/**
 * If the user has authenticated, it does nothing. Otherwise, it returns with the Unauthorized api access response
 * @param boolean $connected 
**/
function loginGuard($connected){
	if(!$connected) apiSendResp(RESP_UNAUTHORIZED);
}


/**
 * makes it so all request to the api/$path get routed to $handler
 * @param string $path uri path of the new api request url
 * @param function(str) $handler function that will decided what to do based on the given api request 
**/
function registerEndpoint($path, $handler){
	global $registredPaths;
	global $pathHandler;
	$registredPaths[] = $path;
	$pathHandler[$path] = $handler;
}

/**
 * executes registerEndpoint for every element in paths 
 * @param array[string] $path uri path of the new api request url
 * @param function() $handler function that will decided what to do based on the given api request 
 * @see registerSubdomain
**/
function registerEndpointList($paths, $handler){
	foreach($paths as $path){
		registerEndpoint($path, $handler);
	}
}

/**
 * creates a regex limiter that matches if and only if the given string is a registered path
 * @return string a regex delimeter 
**/
function getRegisterPathsRegex(){
	global $registredPaths;
	if(empty($registredPaths)) return 'matchnothing^';
	return "^(".implode('|',$registredPaths).")";
}

/**
 * executes the handler for a given $path
 * @param string $path a registered path for the api, which is to say a path that is associated to a handler in apiHandler
**/
function executeHandler($path){
	global $pathHandler;
	$pathHandler[$path]();
}

?>
