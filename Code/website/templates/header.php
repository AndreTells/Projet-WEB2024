<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script src="js/api-access.js"></script>
	<script src="js/templates.js"></script>
</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->

<body>
<?php
if($hash = valider("hash", "SESSION")){
echo "<input type='hidden' value='".$_SESSION["hash"]."' id='hash-field'></input>";
}
?>
	<nav class="navbar navbar-expand-lg bg-main-color">
		<div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="index.php" style="text-decoration: none; color: inherit;">Blabla 2i</a></span>
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
				<div class="navbar-nav d-flex justify-content-between align-items-center">
					<a class="nav-link" href="index.php">Accueil</a>
					<a class="nav-link" href="index.php?view=trajet">Créer un trajet</a>
					<a class="nav-link" href="index.php?view=messages">Messagerie</a>
					<a class="nav-link" href="index.php?view=liste_trajets">Voir les trajets prévus</a>
					<a href="index.php?view=profil" id="profil" class="nav-link">
						<img src="./assets/profile_picture.jpg" alt="Photo de profil" id="profile_picture">
					</a>
				</div>
			</div>
		</div>
	</nav>
