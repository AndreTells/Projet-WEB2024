<?php

/*
Partie modèle : on effectue ici tous les traitements sur la base de données (lecture, insertion, suppression, mise à jour).

Des fonctions sont déjà présentes : vous avez le droit de les modifier ou d'en ajouter à votre guise. Des indications sont données en commentaires.
*/

include_once("maLibSQL.pdo.php");

//*** Il est recommandé de ne pas modifier les fonctions suivantes, utilisées pour l'identification ***

function verifUserBdd($login,$passe)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT id FROM users WHERE pseudo='$login' AND pass='$passe';";

	return SQLGetChamp($SQL);
	// si on avait besoin de plus d'un champ
	// on aurait du utiliser SQLSelect
}

function isAdmin($idUser)
{
	// Vérifie si l'utilisateur est un administrateur
	$SQL ="SELECT id FROM users WHERE id='$idUser' AND role='admin';";
	return SQLGetChamp($SQL); 
}

function isCoach($idUser)
{
	// Vérifie si l'utilisateur est un coach (ou un admin)
	$SQL ="SELECT id FROM users WHERE id='$idUser' AND role IN ('admin', 'coach');";
	return SQLGetChamp($SQL); 
}


function listerCycle()
{

	$SQL = "select * from cycles";
	return parcoursRs(SQLSelect($SQL));

}

function infoCycle($idCycle){

	$SQL = "select nom,description,idCoach,pseudo,reposEntreExercices as repExo,repetitions,reposEntreCycles as repCycles from cycles join users on cycles.idCoach = users.id where cycles.id = '$idCycle'";
	return parcoursRs(SQLSelect($SQL));
}

function exoCycle($idCycle){

	$SQL = "select nom,duree from composition_cycles join exercices on exercices.id = composition_cycles.idExercice where idCycle = '$idCycle'";
	return parcoursRs(SQLSelect($SQL));
}


function creerCycle($nom,$description,$idCoach,$repetition,$repCycles,$repExo){
	$SQL = "insert into cycles(nom,description,idCoach,repetition,reposEntreCycles,reposEntreExercices) values ($nom,$description,$idCoach,$repetition,$repCycles,$repExo)";
	return SQLInsert($SQL);
}
//*** Fin des fonctions fournies avec le sujet ***

// TODO : D'autres fonctions peuvent être ajoutées à la suite









?>