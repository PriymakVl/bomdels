$(document).ready(function() {
    $('.view-list-draws-wp').hide();
    
    $('.view-button-list-draws-wp').click(function() {
        $(this).hide();
        $('.view-button-specification-wp').hide();
        $('.view-list-draws-wp').show(); 
    });
    $('#close_list').click(function() {
        $('.view-list-draws-wp').hide();
        $('.view-button-list-draws-wp, .view-button-specification-wp').show();
    });
});