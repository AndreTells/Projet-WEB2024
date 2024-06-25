<div class="h1 text-center mb-4 mt-2"> Créer un trajet </div>
<div class="container mt-4">
    <!-- Ligne 1 : Date et Direction -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" class="form-control" placeholder="Date">
        </div>
        <div class="col-md-6">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="dropdownDirection" data-bs-toggle="dropdown" aria-expanded="false">
                    Choisir la direction
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownDirection">
                    <li><a class="dropdown-item" href="#">Villeneuve d'Ascq --> Lens</a></li>
                    <li><a class="dropdown-item" href="#">Lens --> Villeneuve d'Ascq</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Ligne 2 : Lieu d'arrivée et Heure d'arrivée -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Lieu d'arrivée">
        </div>
        <div class="col-md-6">
            <input type="time" class="form-control" placeholder="Heure d'arrivée">
        </div>
    </div>

    <!-- Ligne 3 : Lieu de départ et Heure de départ -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Lieu de départ">
        </div>
        <div class="col-md-6">
            <input type="time" class="form-control" placeholder="Heure de départ">
        </div>
    </div>

    <!-- Ligne 4 : Commentaires -->
    <div class="row mb-3">
        <div class="col">
            <textarea class="form-control" rows="4" placeholder="Commentaires"></textarea>
        </div>
    </div>

    <!-- Bouton de soumission -->
    <div class="row mt-4">
        <div class="col text-center">
            <button type="submit" class="btn btn-warning btn-lg">Créer le trajet</button>
        </div>
    </div>
</div>
