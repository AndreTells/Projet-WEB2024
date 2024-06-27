<div class="container">
    <div class="row">
        <div class="row col-6">
            <div class="col-9 mb-0 mt-2 h1"> Nous contacter </div>
        <div class="col-4"><form class="row g-3">
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Prenom </label>
                    <input type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Nom </label>
                    <input type="text" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>

                <div class="col-12">
                    <label for="message" class="form-label">Votre message</label>
                    <textarea class="form-control" id="message" placeholder="Écrivez votre message ici" rows="4"></textarea>
                </div>
                <div class="col-12">
                    <input type="button" class="btn btn-primary" id="btn-feedback" value="Envoyer"></input>
                </div>
            </form></div>
    </div>
    <div class="col-6 img-container">
        <img src="./assets/covoiturage.jpg" alt="Covoiturage Image">
    </div>
    </div>
<script>
$("#btn-feedback").on('click',function(e){
	console.log("aaa");
let request = tryPostFeedback( 
	$("#inputEmail4").val(),
	$("#inputPassword4").val(),
	$("#inputAddress").val(),
	$("#message").val()
);

request.done(function(obj){
	console.log("feedback sent");
});
});
</script>
</div>
