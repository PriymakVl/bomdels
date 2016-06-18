$(document).ready(function() {
   $('#show_info_create_order_box').click(function() {
        $('.menu-create-order-wrp li').each(function() {
           $(this).removeClass('menu-create-order-active');
        });
        $(this).addClass('menu-create-order-active');
        
        $('#create_order_content_box').hide();
        $('#create_order_add_element_box').hide();
        $('#save_new_order').show();
        $('#add_element_to_content').hide();
        $('#create_order_info_box').slideDown(300);
   }); 	
   
   $('#show_content_create_order_box').click(function() {
    
        $('.menu-create-order-wrp li').each(function() {
           $(this).removeClass('menu-create-order-active');
        });
        $(this).addClass('menu-create-order-active');
        $('#create_order_info_box').hide();
        $('#create_order_add_element_box').hide();
        $('#save_new_order').show();
        $('#add_element_to_content').hide();
        $('#create_order_content_box').slideDown(300);
   }); 	
   
   $('#show_add_element_create_order_box').click(function() {
        $('.menu-create-order-wrp li').each(function() {
           $(this).removeClass('menu-create-order-active');
        });
        $(this).addClass('menu-create-order-active');
        
        $('#create_order_info_box').hide();
        $('#create_order_content_box').hide();
        $('#save_new_order').hide();
        $('#add_element_to_content').show();
        $('#create_order_add_element_box input[type="text"]').val('');//reset field 
        $('#create_order_add_element_box').slideDown(300);
   }); 	
});