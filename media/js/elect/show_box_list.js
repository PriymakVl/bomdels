$(document).ready(function() {
    $('#elect_lists_management').click(function() {
       /* $('#add_list').show();
        $('#delete_list').hide();
        $('#save_list').hide();
        $(this).hide();
        $('#show_box_edit_list').show();*/
        
        /*
        $('#form_list input[name="rating"]').val('');
        $('#form_list input[name="listname"]').val('');
        $('#form_list textarea').text('');*/
        
        $('.info-menu-box').hide();
        $('#description_list_box').hide();
        $('#elect_box').hide();
        $('#edit_list_box').show();
        $('#edit_list_box :radio').attr('checked', false);
        //$('#list_form_box').slideDown(300);   
    });
    
    //show box add of list elect
    $('#show_box_add_list').click(function() { 
        $('#edit_list_box').hide(); 
        $('#add_list').show();
        $('#edit_list').hide();
        $('#list_form_box').slideDown(300);       
    });
   
});

