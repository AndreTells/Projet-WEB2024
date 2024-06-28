<div class="content_list">
    <div class="trajet m-5 row bg-secondary-color d-flex justify-content-between align-items-center shadow">
        <img src="./assets/voiture.jpeg" alt="voiture" class="col-3">
        <div class="col-4">
            <h3>IG2I - 19/06/24</h3>
            <p>Heure de départ : 13h30</p>
            <p>Heure d'arrivée : 14h</p>
        </div>
        <div class="col-3 align-text-bottom">
            <p class="align-text-bottom">Lieu de départ : Centrale</p>
            <p class="align-text-bottom">Conducteur : Hugo Dufaure</p>
        </div>
        <div class="col-2">
            <a href="./index.php?view=page"><img src="./assets/arrow_btn.png" alt="arrow button"></a>
        </div>
    </div>
        
    </div>
</div>

<script>
$(document).ready( function(){
    // Start of car list
    let request = tryGetTripList();
    request.done(function(response){
        for (let i = 0; i < response["trips"].length; i++) {

            let trip = response["trips"][i];
            console.log(trip);
            $(".content_list").prepend(
                trajetInfoTemplate(trip)
            );
        }
    });
    
}

);


</script>
