$(document).ready(function() {
    $('#show_box_add_list').click(function() {
        $('#add_list').show();
        $('#delete_list').hide();
        $('#save_list').hide();
        $(this).hide();
        $('#show_box_edit_list').show();
        
        $('#form_list input[name="rating"]').val('');
        $('#form_list input[name="listname"]').val('');
        $('#form_list textarea').text('');
        
        $('.info-menu-box').hide();
        $('#elect_box').hide();
        $('#edit_list_box').hide();
        $('#list_form_box').slideDown(300);   
    });
    //list employee edit
    $('#show_box_edit_list').click(function() { 
        $('#elect_box').hide();
        $('.info-menu-box').hide();
        $(this).hide();
        $('#list_form_box').hide();
        $('#show_box_add_list').show();
        $('#edit_list_box').slideDown(300).css('width', '100%'); 
        $('#edit_list_box :radio:checked').attr('checked', false);
    });
   
});

