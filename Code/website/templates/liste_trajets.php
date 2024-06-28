<div class="content_list">
    
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
