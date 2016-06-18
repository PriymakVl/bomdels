$(document).ready(function() {
    $('#sort-type-sundbirsta').change(function() {
        var id = getGetParam('id');
        var type_details = $(this).val();
        location.search = "?id=" + id + "&det=" + type_details;
    });
    //sort by type details
});

function getGetParam(name){
    var data = location.search.substring(1).split("&"); 
    for (var i = 0; i < data.length; i++){
        var params = data[i].split("=");
        if(params[0] == name) return params[1];
    }
}
