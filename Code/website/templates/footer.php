<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>

<div  class="row text-center fixed-bottom">
	<div class="col-3">
		<strong>Blabla 2i</strong>
	</div>
	<div id="social_medias" class="col-6">
		<img src="./assets/logos/facebook.png" alt="Facebook">
		<img src="./assets/logos/linkedin.png" alt="Linkedin">
		<img src="./assets/logos/youtube.png" alt="YouTube">
		<img src="./assets/logos/instagram.png" alt="Instagram">
	</div>
	<div class="col-3">
		Tout droit réservé
	</div>
</div>

</body>
</html>