$(document).ready(function() {
    $('.view-specification-wp').hide();
    
    $('.view-button-specification-wp').click(function() {
        $(this).hide();
        $('.view-button-list-draws-wp').hide();
        $('.view-specification-wp').show(); 
    });
    
    $('#close_specification').click(function() {
        $('.view-specification-wp').hide();
        $('.view-button-specification-wp, .view-button-list-draws-wp').show();
    });
});