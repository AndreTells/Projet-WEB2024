<div class="m-5">
    <div class="row align-items-center m-3" id="trip-info">
    </div>
    <hr>
    <div id="passengers" class="m-3">
        <h2>Passagers</h2>
        <div class="row m-5 align-items-center">
            <div class="col-2">
                <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
            </div>
            <p class="col-4">Hugo Dufaure</p>
            <button class="btn btn-warning col-2 me-2">Contacter</button>
            <button class="btn btn-danger col-2 ms-2">Supprimer</button>
        </div>
    </div>
    <hr>
    <div id="actions" class="d-flex justify-content-center m-4">
        <button class="btn btn-warning me-3">Discussion</button>
        <button class="btn btn-warning ms-3">Réserver</button>
    </div>
</div>


<!-- TODO GET ALL USERS FROM RESERVATION FOR TRIP ID -->
<script>
$(document).ready(function(){
    // console.log("hi");
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const tripId = urlParams.get('trip');
    // console.log(tripId);

    let request = tryGetTripById(tripId);
    request.done(
        function(response){
            // console.log(response);
            let trip = response["trip"];
            let date = Date.parse(trip["date"],"dd-mm-yyyy");
            trip["date"] = date;
            $("#trip-info").append(
                tripInfoTemplate(trip)
            );
            // tripInfoTemplate
            
        }
    )


}
);
</script>
