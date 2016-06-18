$(document).ready(function() {
    //show box registr employee
    $('#registr').click(function() {
        $('#elect_box').hide();
        $('.info-menu-box').hide();
        $('#registr_box').slideDown(300);  
    });
    

      //hide box registr employee
    $('#registr_cancel').click(function() {
        $('#registr_box').hide();
        $('.info-menu-box').show();
        $('#elect_box').slideDown(300);
        
    });
   
});

