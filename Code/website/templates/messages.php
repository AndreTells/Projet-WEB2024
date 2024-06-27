<div class="message_page row text-center mt-3">
    <div id="messages_list" class="col-3 border-end pe-0">
        <h5>Messagerie privée</h5>
        <div class="mt-3">
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center selected">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Victor Pitaud</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Hugo Dufaure</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
            <div class="conv pt-2 pb-2 d-flex justify-content-around align-items-center">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Isabelle Le Glaz</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
            <div class="conv hidden pt-2 pb-2 d-flex justify-content-around align-items-center">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Hugo Dufaure</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
            <div class="conv hidden pt-2 pb-2 d-flex justify-content-around align-items-center">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Hugo Dufaure</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
            <div class="conv hidden pt-2 pb-2 d-flex justify-content-around align-items-center">
                <div>
                    <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
                </div>
                <div>
                    <h6>Hugo Dufaure</h6>
                    <p>Ok pas de soucis</p>
                </div>
            </div>
        </div>
    </div>
    <div id="conversation" class="col-7 border-end">
        <h5 class="selected-name">Victor Pitaud</h5>
        <hr>
        <div id="messages">

        </div>
        <input id="input_bar" type="text" placeholder="  Entrer votre message">
    </div>
    <div id="conv-profile" class="col-2">
        <h5 class="selected-name">Victor Pitaud</h5>
        <div>
            <img src="./assets/profile_picture.jpg" alt="PP" class="pp">
        </div>
        <button id="profile_btn" class="mt-3 btn btn-warning">Voir le profil</button>
    </div>
</div>

<script>

    $(document).ready(function() {
        recupMsg();
    });

    $("#profile_btn").click(function(){
        window.location.href = "./index.php?view=profil";
    });

    $(".conv").click(function(){
        $(".selected").removeClass("selected");
        $(this).addClass("selected");
        $(".selected-name").html($(this).find("h6").html());

        $("#messages").html("");
        $("#input_bar").val("");
        recupMsg();
    });

    $("#input_bar").on("keydown",function(contexte){

        if(contexte.which == 13 && $("#input_bar").val() != ""){
            afficherMsg($("#input_bar").val());
            $("#input_bar").val("");
        } 
    })

    function afficherMsg(value,sender=true){
        if(sender){
            sender_class = "sm";
            align = "end";
        }else{
            sender_class = "rm";
            align = "start";
        }

        $("#messages").append("<div class='d-flex justify-content-" + align + "'><div class='message " + sender_class +"'>" +  $("#input_bar").val() + "</div></div>");

    }

    function recupMsg(){

        //messages = fct backend pour récuperer les messages
        //foreach afficherMsg

    }

</script>