<div class="h1 text-center mb-4 mt-2"> Créer un trajet </div>
<div class="container mt-4">
    <!-- Ligne 1 : Date et Direction -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="date" class="form-control" placeholder="Date" id="date-input">
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
            <input type="text" class="form-control" placeholder="Lieu d'arrivée" id="arrival-place">
        </div>
        <div class="col-md-6">
            <input type="time" class="form-control" placeholder="Heure d'arrivée" id="arrival-time">
        </div>
    </div>

    <!-- Ligne 3 : Lieu de départ et Heure de départ -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Lieu de départ" id="depart-place">
        </div>
        <div class="col-md-6">
            <input type="time" class="form-control" placeholder="Heure de départ" id="depart-time" >
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
            <button type="submit" class="btn btn-warning btn-lg" id="create-trip">Créer le trajet</button>
        </div>
    </div>
</div>


<script>
    let from = "";
    let to = "";
    $(".dropdown-menu a").click(function(){
        $(".btn-secondary:first-child").text($(this).text());
        if ($(this).text().includes("-->")) {
            from = $(this).text().split(" --> ")[0];
            to = $(this).text().split(" --> ")[1];
        } else {
            from = $(this).text().split(" --> ")[1];
            to = $(this).text().split(" --> ")[0];
        }
        if (from[0] == "V"){
            from = "Villeneuve";
        }
        else{
            from = "Lens";
            to = "Villeneuve";
        }
    });

    $("button[type='submit']").click(function(){
        let date = $("#date-input").val() + " 05:00:00" ;
        console.log(date);
        let hour_depart = $("#depart-time").val();
        console.log(hour_depart);
        let hour_arrival = $("#arrival-time").val();
        console.log(hour_arrival);
        let description = $("textarea").val();
        console.log(description);
        let direction = to == "Villeneuve" ? "Villeneuve" : "Lens";
        if (!(date && hour_depart && hour_arrival && description && direction)){
            console.log("Missing information");
            return;
        }
        console.log("aaa");
        let req_conversation = tryPostConversation();
        req_conversation.done(function(response){
            console.log(response);
            // console.log(response["conversation"]["id"]);
            let conversation_id = response["conversation"]["id"];
            
            let request = tryPostTrip(from, to, hour_depart, hour_arrival, direction, date, description, conversation_id);
            request.done(function(response2){
                console.log("AA");
                console.log(response2);
            });
        });
    });



</script>