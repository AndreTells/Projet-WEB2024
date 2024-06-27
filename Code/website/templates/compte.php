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
</script>
<div class="h1 text-center mb-4 mt-2">Créer votre compte</div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <form class="row g-3" enctype="multipart/form-data">
                <div class="col-md-12 h6 text-center">Informations de connexion</div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Votre email" required>
                </div>
                <div class="col-md-12">
                    <label for="inputPassword4" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Votre mot de passe" required>
                </div>
                <div class="col-md-12">
                    <label for="inputPassword_confirm4" class="form-label">Confirmer votre mot de passe</label>
                    <input type="password" class="form-control" id="inputPassword_confirm4" placeholder="Confirmer votre mot de passe" required>
                </div>

                <div class="mt-5 col-md-12 h6 text-center">Quelques informations sur vous</div>
                <div class="col-md-12">
                    <label for="inputPseudo" class="form-label">Pseudo</label>
                    <input type="text" class="form-control" id="inputPseudo" placeholder="Votre pseudo" required>
                </div>
                <div class="col-md-12">
                    <label for="inputJob" class="form-label">Métier</label>
                    <input type="text" class="form-control" id="inputJob" placeholder="Votre métier" required>
                </div>
                <div class="col-md-12">
                    <label for="inputTel" class="form-label">Tel</label>
                    <input type="text" class="form-control" id="inputTel" placeholder="Votre téléphone" required>
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
                <div class="col-md-12">
                    <label for="inputProfilePicture" class="form-label">Photo de profil</label>
                    <input type="file" class="form-control" id="inputProfilePicture" name="profile_picture" required>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-lg position-relative top-100 start-50 translate-middle">S'inscrire</button>
                </div>
            </form>
        </div>
        <div class="col-6 img-container">
            <img src="./assets/creer_compte.png" alt="Créer Compte Image">
        </div>
    </div>
</div>