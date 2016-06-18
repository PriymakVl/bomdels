$(document).ready(function() {
    $('#sections').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_sections_box').show();
        $('#menu_elect_box').hide();
        $('#menu_admin_box').hide();
    });
    
    $('#elect').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_sections_box').hide();
        $('#menu_elect_box').show();
        $('#menu_admin_box').hide();
    });
    
      $('#admin').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_sections_box').hide();
        $('#menu_elect_box').hide();
        $('#menu_admin_box').show();
    });
})