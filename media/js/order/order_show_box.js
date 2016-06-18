$(document).ready(function() {
   // $('#add_data').click(function() {
//        $('.right-sidebar-header li').each(function() {
//            $(this).removeClass('active-item-menu-sidebar');
//        });
//        $(this).addClass('active-item-menu-sidebar');
//        $('#data_add_box').show();
//        $('#data-action-box').hide();
//    });
//    
//    $('').click(function() {
//        $('.right-sidebar-header li').each(function() {
//            $(this).removeClass('active-item-menu-sidebar');
//        });
//        $(this).addClass('active-item-menu-sidebar');
//        $('#data-action-box').css('display', 'block');
//        $('#data_add_box').css('display', 'none');
//    });
    
    $('#show_order_info').click(function() {
        $('#menu_content_order li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#order_content_box').hide();
        $('#order_info_box').slideDown(300); 
    });
    
     $('#show_order_content').click(function() {
        $('#menu_content_order li').each(function() {
            $(this).removeClass('active-item-menu-sidebar');
        });
        $(this).addClass('active-item-menu-sidebar');
        $('#order_info_box').hide();
        $('#order_content_box').slideDown(300); 
    });
})