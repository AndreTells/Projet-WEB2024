<div class="row text-center mt-3">
    <div id="messages_list" class="col-3 border-end pe-0">
        <h5>Messagerie </h5>
        <div class="mt-3">
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center selected">
                <div>
                    <h6>Victor Pitaud</h6>
                </div>
            </div>
        </div>
    </div>
    <div id="conversation" class="col-7 border-end">
        <h5 class="selected-name">Victor Pitaud</h5>
        <hr>
	<div style="display:flex;flex-direction:column;height:fit-content">
        <div class="message rm">J'ai reçu ce message</div>
        <div id="temp-m2" class="message sm">J'ai envoyé ce message</div>
        <div id="temp-m3" class="message sm">J'ai envoyé ce message</div>
        <div id="temp-m4" class="message sm">J'ai envoyé ce message</div>
	</div>
        
	<div>     <input  type="text" placeholder="  Entrer votre message" id="message-text">
		<input type="button" value="send" id="message-send-btn"></input>
	</div>
    </div>
    <div id="conv-profile" class="col-2">
        <h5 class="selected-name">Victor Pitaud</h5>
        <div>
            <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
        </div>
        <button class="mt-3 btn btn-warning">Voir le profil</button>
    </div>
</div>

<script>
conv_id = 1;
function loadMessages(){
	let request = tryGetMessages(conv_id);
request.done(function(obj){
	console.log(obj);
});
}
    $(".conv").click(function(){
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
        $(".selected-name").html($(this).find("h6").html());
    });

    $("#message-send-btn").on('click', function(){
	  let request =  tryPostMessage(
		    conv_id,
		    $("#message-text").val()
	);
	   
request.done(function(obj){
	console.log("here");
	loadMessages();
    });
});
</script>
