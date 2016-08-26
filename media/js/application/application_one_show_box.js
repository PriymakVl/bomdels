$(document).ready(function() {
    $('#menu_app_main_box li').click(function() {
        $('#menu_app_main_box li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
    });
    
    $('#app_info').click(function() {
        $('#app_list_item_box').fadeOut(900);
        $('#app_info_box').fadeIn(900);
        $('.info-menu-box').text('Информация по заявке');
    });
    
     $('#app_list').click(function() {
        $('#app_info_box').fadeOut(900);
        $('#app_list_item_box').fadeIn(900);
        $('.info-menu-box').text('Перечень позиций заявки');
             
    });
    
     $('#manager_link').click(function() {
        $('#main_link').removeClass('active-item-menu-sidebar');
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_app_main_box').hide();
        $('#menu_app_manager_box').show();  
    });
    
    $('#main_link').click(function() {
        $('#manager_link').removeClass('active-item-menu-sidebar');
        $(this).addClass('active-item-menu-sidebar');
        $('#menu_app_main_box').show();
        $('#menu_app_manager_box').hide();  
    });
})








