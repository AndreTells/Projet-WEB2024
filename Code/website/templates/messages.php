<div class="row text-center mt-3">
    <div id="messages_list" class="col-3 border-end pe-0">
        <h5>Messagerie </h5>
        <div class="mt-3">
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center selected" id="conversation-list">
            </div>
        </div>
    </div>
    <div id="conversation" class="col-7 border-end">
        <h5 class="selected-name">SELECTIONEZ UN CHAT</h5>
        <hr>
	<div style="display:flex;flex-direction:column;height:fit-content;max-height:300px;overflow-y: scroll; " id = "conversation-message-area">
	</div>
        
	<div>     <input  type="text" placeholder="  Entrer votre message" id="message-text">
		<input type="button" value="send" id="message-send-btn"></input>
	</div>
    </div>
<!--
    <div id="conv-profile" class="col-2">
        <h5 class="selected-name">Victor Pitaud</h5>
        <div>
            <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
        </div>
        <button class="mt-3 btn btn-warning">Voir le profil</button>
    </div>-->
</div>

<script>
conv_id = false;
function loadMessages(){
	if(!conv_id) return;
	let request = tryGetMessages(conv_id);
request.done(function(obj){
	obj.messages = obj.messages.map(function(x){	
		x.post_time = Date.parse(x.post_time);
		return x;
	});
	obj.messages.sort(function(a,b){return b.post_time - a.post_time});
	obj.messages.reverse();
	console.log(obj);

	$("#conversation-message-area").html("");
	$("#conversation-message-area").append(obj.messages.map(messageTemplate));
});
}

function loadConverstations(){
	let request = tryGetConversations(); 	
	
	request.done(function(obj){
		$("#conversation-list").html("");
		$("#conversation-list").append(obj.conversations_aux.map(convTemplate));
	});
}
	setInterval(loadMessages, 5000); 
	setInterval(loadConverstations, 5000); 
    $(document).on('click', '.conv div', function(){
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
        $(".selected-name").html($(this).find("h6").html());
	conv_id = $(this).data("id");
	loadMessages();
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


$(document).ready(function(){ loadConverstations(); });
</script>
