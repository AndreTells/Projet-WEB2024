<script>
    function toggleVehicleFields() {
        var vehicleFields = document.getElementById("vehicleFields");
        var checkbox = document.getElementById("vehicleCheckbox");
        if (checkbox.checked) {
            vehicleFields.style.display = "block";
        } else {
            vehicleFields.style.display = "none";
        }
    }

    $(document).ready(function(){
        getCurrentSettings();
    });

    function getCurrentSettings(){

        console.log("Mise a jour des champs pour modification");

        //fonction de backend pour récuperer les infos de l'utilisateur actuel
        cEmail = "victor.pitaud@centrale.centralelille.fr";
        cOwnVehicule = true;
        if(cOwnVehicule){
            cCar = "Clio 2";
            cNbPlaces = 3;
        }
        cPseudo = "vpitaud";
        cJob = "Etudiant";
        cTel = "+33781958413";

        $("#inputEmail4").val(cEmail);
        $("#vehicleCheckbox").attr('checked',cOwnVehicule);
        if(cOwnVehicule){
            vehicleFields.style.display = "block";
            $("#inputCar").val(cCar);
            $("#inputPlace").val(cNbPlaces);
        }
        $("#inputPseudo").val(cPseudo);
        $("#inputJob").val(cJob);
        $("#inputTel").val(cTel);

    }



</script>

<div class="h1 text-center mb-4 mt-2"> Éditer votre profil </div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <form class="row g-3">
                <div class="col-md-12 h6 text-center"> Informations de connexion </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Mot de passe </label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label"> Confirmer votre mot de passe </label>
                    <input type="confirm_password" class="form-control" id="inputPassword_confirm4">
                </div>

                <div class="col-md-12 mt-4">
                    <input class="form-check-input" type="checkbox" id="vehicleCheckbox" onclick="toggleVehicleFields()">
                    <label class="form-check-label" for="vehicleCheckbox">Possédez-vous un véhicule ?</label>
                </div>

                <div id="vehicleFields" style="display: none;">
                    <div class="col-md-12 h6 text-center">Véhicule</div>
                    <div class="col-12">
                        <label for="inputCar" class="form-label">Modèle de voiture</label>
                        <input type="text" class="form-control" id="inputCar" placeholder="Votre modèle de voiture">
                    </div>
                    <div class="col-12 mt-2">
                        <label for="inputPlace" class="form-label">Nombre de places</label>
                        <input type="text" class="form-control" id="inputPlace" placeholder="Le nombre de places de votre voiture">
                    </div>
                </div>

                <div class="col-md-12 h6 text-center"> Quelques informations sur vous </div>

                <div class="col-md-12">
                    <label for="inputPseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="inputPseudo" placeholder="Votre pseudo">
                </div>
                <div class="col-md-12">
                    <label for="inputJob" class="form-label">Métier</label>
                    <input type="text" class="form-control" id="inputJob" placeholder="Votre métier">
                </div>
                <div class="col-md-12">
                    <label for="inputTel" class="form-label">Tel </label>
                    <input type="text" class="form-control" id="inputTel" placeholder="Votre téléphone">
                </div>

                <div class="col-12">
                    <button type="change" class="btn btn-warning btn-lg position-relative top-100 start-50 translate-middle">Modifier mes informations</button>
                </div>
            </form>
        </div>
    </div>
</div>


