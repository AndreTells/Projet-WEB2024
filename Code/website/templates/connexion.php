<div class="h1 text-center mb-4 mt-2"> Bienvenue à Blabla2i, Connectez-vous ! </div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <form class="row g-3">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Nom</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-12 mb-5">
                    <label for="inputPassword4" class="form-label">Mot de passe </label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
            <div class="col-12">
                <input type="submit" class="btn btn-primary" id="btn-login" value = "Se connecter"></input>
            </div>

            <div class="h4 mb-3 mt-5"> Pas de compte ? </div>
            <div class="col-12">
            <input type="submit" class="btn btn-primary" id="btn-create" value="Creer mon compte"></input>
            </div>
        </div>
        </form>
        <div class="col-6 img-container">
            <img src="./assets/connexion.png" alt="Connexion Image">
        </div>
    </div>
</div>

<script>
$("#btn-login").on('click', function(){
	let request = tryPostAuthenticate($("#inputEmail4").val(), $("#inputPassword4").val());	
	request.done(function(obj){
		obj = JSON.parse(obj);
		if(obj.success) window.location.href=`index.php?hash=${obj.hash}`;
	});
});
$("#btn-create").on('click', function(){
	let request = tryPostCreateUser($("#inputEmail4").val(), $("#inputPassword4").val());	
	request.done(function(obj){
		obj = JSON.parse(obj);
		if(obj.success) window.location.href=`index.php?hash=${obj.hash}`;
	});
});
</script>
