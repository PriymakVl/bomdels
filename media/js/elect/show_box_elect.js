$(document).ready(function() {
    $('#sections').click(function() {
        $('.right-sidebar-header li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_sections_box').show();
        $('#menu_elect_box').hide();
        $('#menu_admin_box').hide();
        $('.info-menu-box').show();
        $('#description_list_box').show();
        $('#elect_box').show();
        $('#edit_list_box').hide();
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
    
    //management elect box
    $('#elect_elements_management').click(function() {
        $('#menu_elect_main_box').hide();
        $('#menu_elect_list_box').hide();
        $('#menu_elect_elements_box').show();
    });
    
     $('#elect_lists_management').click(function() {
        $('#menu_elect_main_box').hide();
        $('#menu_elect_list_box').show();
        $('#menu_elect_elements_box').hide();
    });
    
    
     $('.cancel_elect_subbox').click(function() {
        $('#menu_elect_main_box').show();
        $('#menu_elect_list_box').hide();
        $('#menu_elect_elements_box').hide();
        $('#element_form_box').slideUp();
        $('.info-menu-box').show();
        $('#description_list_box').show();
        $('#elect_box').show();
        $('#edit_list_box').hide(); 
        $('#list_form_box').hide();
    });
})