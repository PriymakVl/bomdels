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
})