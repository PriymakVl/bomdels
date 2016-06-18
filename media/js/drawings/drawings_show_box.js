$(document).ready(function() {
    //show box sidebar menu
    $('#pages').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_pages_box').show();
        $('#menu_action_box').hide();
    });
    
      $('#manager_link').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_action_box').show();
        $('#menu_pages_box').hide();
    });
    
    /** show box form add note */
    $('#add_note').click(function() {
        var draw_id = $(':radio:checked').attr('draw_id');
        if(draw_id) {
            var note = $(':radio:checked').attr('note');
            $('textarea[name="note"]').val(note);
            $('#drawings_main_box').hide();
            $('#drawings_form_note_box').show();     
            
        } 
        else alert('Выберите чертеж');
    });
    
    //hide box form add note 
    $('#cancel_note').click(function() {
        $('#drawings_main_box').show();
        $('#drawings_form_note_box').hide();     
    });
    
    //hide box with by full note
     $('#hide_note').click(function() {
        $('#full_note_box').hide();
    });
    //show box with by full note
    $('#show_note').click(function() {
        $('#full_note_box').show();
    });
    
    //show box with by full data drawing
    $('#show_data').click(function() {
        $('#drawing_data_box').show();
        $('#drawings_main_box').hide();
    });
    
    //show box with by full data drawing
    $('#hide_data').click(function() {
        $('#drawing_data_box').hide();
        $('#drawings_main_box').show();
    });
    
    //show box add draw
    $('#show_add_draw_box').click(function() {
        $('#drawings_main_box').hide();
       $('#drawings_form_draw_box').slideDown(300);
    });
    
      $('#cancel_draw').click(function() {
        $('#drawings_form_draw_box').hide();
       $('#drawings_main_box').slideDown(300);
    });
});











