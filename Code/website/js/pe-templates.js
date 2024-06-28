const trajetInfoTemplate = (obj) => $(`
    <div class="trajet m-5 row bg-secondary-color d-flex justify-content-between align-items-center shadow">
        <img src="./assets/profile_picture.jpg" alt="profile_picture" class="col-3">
        <div class="col-4">
            <h3>${obj.to_location}</h3>
            <p>Heure de départ : ${obj.hour_depart}</p>
            <p>Heure d'arrivée : ${obj.hour_arrival}</p>
        </div>
        <div class="col-3 align-text-bottom">
            <p class="align-text-bottom">Lieu de départ : ${obj.from_location}</p>
            <p class="align-text-bottom">Conducteur : ${obj.conductor_name}</p>
        </div>
        <div class="col-2">
            <a href="./index.php?view=page&trip=${obj.id}"><img src="./assets/arrow_btn.png" alt="arrow button"></a>
        </div>
    </div>
`).data(obj);



const tripInfoTemplate = (obj) => $(`
        <img src="./assets/voiture.jpeg" alt="voiture" class="col-4" id="page-img">
        <div id="text-content" class="col-8">
            <h2>IG2I - 19/06/2024</h2>
            <p>
                <strong>Description :</strong><br>
                ${obj.description}
            </p>
            <strong>Départ à ${obj.hour_depart} de ${obj.from_location}</strong> <br>
            <strong>Arrivée à ${obj.hour_arrival} à ${obj.to_location}</strong>
            <div class="row m-5 align-items-center">
                <div class="col-2">
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <p class="col-6">${obj.conductor_name}</p>
                <button class="btn btn-warning col-4">Contacter</button>
            </div>
        </div>
    
    `).data(obj);