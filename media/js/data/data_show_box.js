$(document).ready(function() {
    $('#add_data').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#data_add_box').show();
        $('#data-action-box').hide();
    });
    
      $('#manager_link').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_action_box').css('display', 'block');
        $('#data_add_box').css('display', 'none');
    });
    
    /** show box form add note */
    $('#add_note').click(function() {
        var note = $('#full_note_field').attr('note');
        $('textarea[name="note"]').val(note);
        $('#detail_form_note_box').show();
        $('.info-menu-box').hide();
        $('.detail-info').slideUp(300);
             
    });
    
    /* hide box form add note */
    $('#cancel_note').click(function() {
        $('#detail_form_note_box').hide();
        $('.info-menu-box').show();
        $('.detail-info').slideDown(300);         
    });
    
    /* show full note box*/
    $('#link_full_note').click(function() {
        var note = $(this).attr('note');
        $('#full_note_box p').text(note);  
        $('#full_note_box').show();      
    });
    
    /* hide full note box */
    $('#hide_note').click(function() {
       $('#full_note_box').hide(); 
    });
})








