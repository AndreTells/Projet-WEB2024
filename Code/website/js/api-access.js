const apiRoot = "http://localhost/database-api/api";
var token = false;
$(document).ready(function(){
	if($("#hash-field").length){
		token = $("#hash-field").val();
	}
});

/**
 * @param string param      string containing the title for the new article
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list
 */
let tryPostFeedback = function (prenom, nom, email, message) {
	console.log(apiRoot);
	let request = $.post(
		apiRoot + "/feedback",
		{
			"prenom": prenom,
			"nom": nom,
			"email": email,
			"message": message
		}
	);
	return request;


}
/**
 * @param string param      string containing the title for the new article
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list
 */
let tryPostMessage = function (conv_id, content) {
	let request = $.post(
		apiRoot + "/send-message",
		{
			"hash": token,
			"conv_id": conv_id,
			"content": content
		}
	);
	return request;
}

/**
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list 
 */
let tryGetMessages = function (conv_id) {
	let request = $.getJSON(
		apiRoot + "/messages",
		{
			"conversation_id": conv_id
		}
	);
	return request;
}

/**
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list 
 */
let tryGetConversations = function () {
	let request = $.getJSON(
		apiRoot + "/conversation_aux/info",
		{
			"hash": token
		}
	);
	return request;
}


let tryGetTripList = function () {
	let request = $.getJSON(
		apiRoot + "/trip/list"
	);

	return request;
}

let tryGetTripById = function (id) {
	let request = $.getJSON(
		apiRoot + "/trip/id?id=" + id
	);

	return request;
}



/**
 * @param string login      string containing the login typed by the user
 * @param string password   string containing the password typed by the user
 * @return jqXHR            object of the XMLHTTPRequest made to the api to login the user
 */
let tryPostAuthenticate = function(user,password){
	console.log("attempting to login:" + user+ " "+ password);
        let request = $.post(
                apiRoot + "/authenticate",
                {"name": user, "password": password},
                "json"
        )
        request.done(function(obj){
                obj = JSON.parse(obj);
		if(!obj["success"]) return;
                console.log("token was registered");
                token = obj.hash;
                $.ajaxSetup({
                        dataType: "json"
                });
        });
        return request;
}

/**
 * @param string param      string containing the title for the new article
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list
 */
let tryPostCreateUser = function(user,password){
	let request = $.post(
		apiRoot + "/create-user",
		{
		"name": user,
		"password": password,
		"mail": " ",
		"description": " ",
		"job": " "
		}
	);
        request.done(function(obj){
                obj = JSON.parse(obj);
		if(!obj["success"]) return;
                console.log("token was registered");
                token = obj.hash;
                $.ajaxSetup({
                        dataType: "json"
                });
        });
        return request;
}
