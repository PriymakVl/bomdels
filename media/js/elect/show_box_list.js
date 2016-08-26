$(document).ready(function() {
    //controller elect
    $('#elect_lists_management').click(function() {      
        $('.info-menu-box').hide();
        $('#description_list_box').hide();
        $('#elect_box').hide();
        $('#edit_list_box').show();
        $('#edit_list_box :radio').attr('checked', false);  
    });
    
    //show box add of list elect controller elect
    $('#show_box_add_list').click(function() { 
        $('#edit_list_box').hide(); 
        $('#add_list').show();
        $('#edit_list').hide();
        $('#list_form_box').slideDown(300);       
    });
});

