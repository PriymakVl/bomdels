$(document).ready(function() {
    $('#hide').click(function() {
        var sort = getArraySortValue();
        var action = $(this).attr('id');
        $('.content a[title]').each(function() {
            var title = $(this).text();
            var found = searchMarker(title, sort);
            if(found == false && action == 'hide') $(this).parent().parent().show();
            else if(found == true && action == 'hide') $(this).parent().parent().hide();
            console.log(action);
        })    
    }); 
    $('#reset').click(function() {
        location.reload();
    })
});

function getArraySortValue() {
    var arr = [];
    var list = document.getElementsByTagName('input');
    for (var i=0; i<list.length; i++)
    {
        if(list[i].checked) {
            arr.push(list[i].value);    
        }   
    } 
    return arr;   
}

function searchMarker(str, arr) {
    for (var i = 0; i < arr.length; i++) {
        if(~str.toLowerCase().indexOf(arr[i])) return true;
    } 
    return false;   
}