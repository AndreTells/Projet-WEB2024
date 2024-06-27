const apiRoot = "http://localhost/database-api/api";
var toke = `web`;

$.ajaxSetup({
dataType: "json"
});
/**
 * @param string param      string containing the title for the new article
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list
 */
let tryPostFeedback = function(prenom, nom,email,message){
	console.log(apiRoot);
	let request = $.post(
		apiRoot + "/feedback",
		{
		"prenom":prenom, 
		"nom":nom,
		"email":email,
		"message":message
		}
	);
	return request;


}
/**
 * @param string param      string containing the title for the new article
 * @return jqXHR            object of the XMLHTTPRequest made to the api to get the article list
 */
let tryPostMessage = function(conv_id,content){
	let request = $post(
		apiRoot + "/send-message",
		{
		"hash": token,
		"conv_id":conv_id,
		"content":content
		}
	);
	return request;
}
