<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

// On envoie l'entête Content-type correcte avec le bon charset
header('Content-Type: text/html;charset=utf-8');

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->
<head>	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<title>Blabla 2i</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->
<body>

<div id="banniere">

	<div id="logo">
		<strong>Blabla 2i</strong>
	</div>
	<a href="index.php?view=course_form">Créer un trajet</a>
	<a href="index.php?view=messages">Messagerie</a>
	<a href="index.php?view=reservation">Réserver un véhicule</a>
	<a href="index.php?view=course_list">Voir les trajets prévus</a>

	<div id="profil">
		<img src="./assets/profile_picture.jpg" alt="Photo de profil" id="profile_picture">
	</div>

</div>