$(document).ready(function() {
    $('#filter').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_pages_box').hide();
        $('#menu_action_box').hide();
        $('#sort_menu_danieli_box').show();
    });
    
    $('#manager_link').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_action_box').show();
        $('#menu_pages_box').hide();
        $('#sort_menu_danieli_box').hide();
    });
    
    $('#pages').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_action_box').hide();
        $('#menu_pages_box').show();
        $('#sort_menu_danieli_box').hide();
    });
})