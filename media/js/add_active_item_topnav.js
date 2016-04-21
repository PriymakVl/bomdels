$(document).ready(function() {
    var url = window.location.search;
    var path;
    console.log(url);
    
    if (url == '') {
        $('.topnav a:first').addClass('current-item-topnav');
        return;
    }
    
    
    $('.topnav a').each(function() {
        path = $(this).attr('href').split('/')[1];
        console.log(path);
        if( url == path) {
            $(this).addClass('current-item-topnav');
            return;    
        }
    });
});