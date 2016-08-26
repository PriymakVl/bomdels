$(document).ready(function() {
	$('#save_app').click(function() {
        $('#form_update_app').submit();
	});
    
    $('#cancel_save_app').click(function() {
        $('#form_update_app :radio:checked').parent().parent().find('span').show();
        $('#form_update_app :radio:checked').parent().parent().find('select, textarea, :text').hide();
        $('#save_app, #cancel_save_app').hide();
        $('#add_elect, #delete_app_item, #update_app').show();
    });
    
    $('#manager_link').click(function() {
    	$('#menu_app_main_box').hide();
    	$('#menu_app_manager_box').show();
    });
    
    $('#update_app').click(function() {
        $('#add_elect, #delete_app_item').hide();
        $('#app_list_item_box').fadeOut(900);
        $('#app_info_box').fadeIn(900);
        $('.info-menu-box').text('Информация по заявке');
//        var checked = $('#form_update_app :radio:checked').attr('name');
//        if(!checked) {
//            alert('Выберите поле для редактирования');
//            return;    
//        }
        $(this).hide();
    	$('#save_app, #cancel_save_app').show();
    });
    
    $('#form_update_app :radio').change(function() {
        $('#form_update_app :radio').each(function() {
            $(this).parent().parent().find('span').show();
            $(this).parent().parent().find('select, textarea, :text').hide();
        })
        $('#form_update_app :radio:checked').parent().parent().find('span').hide();
        $('#form_update_app :radio:checked').parent().parent().find('select, textarea, :text').show();
    });
    
    $('#form_update_app select').change(function() {
       var value = $(this).val();
       $(this).siblings('span').text(value); 
    });
    
    $('#form_update_app :text').keydown(function() {
       var value = $(this).val();
       $(this).siblings('span').text(value); 
    });
    
    $('#form_update_app textarea').keydown(function() {
       var value = $(this).val();
       $(this).siblings('span').text(value); 
    });
    
    
    
});