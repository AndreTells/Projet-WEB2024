const apiRoot = "http://localhost:8888/Projet-WEB2024/Code/database-api/api";
const toke = `web`;

$.ajaxSetup({
    dataType: "json"
});


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