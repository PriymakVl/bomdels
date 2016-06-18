var path = '';
$(document).ready(function() {
	$('#search_detail_equipment_database').click(function() {
	   var equipment = $('#database_equipment').val();

       var code = $('#create_order_add_element_search_box input[name="code"]').val();
       if(!equipment) {alert('Вы не выбрали базу оборудования'); return;}
       if(!code) {alert('Вы не указали код детали(узла)'); return;}
       $.post('/search/order', {code: code, equipment: equipment}, showDataDetail);
	});
});

function showDataDetail(data) {
    if(!data) {alert('Ничего не найдено'); return;}
    var detail = JSON.parse(data);
    var file = detail.drawings.file;
    
    if(detail.code) $('#create_order_add_element_box input[name="code_elem"]').val(detail.code);
    else $('#create_order_add_element_box input[name="code_elem"]').val('');
    
    if(file) $('#create_order_add_element_box input[name="drawing_elem"]').val(file);
    else $('#create_order_add_element_box input[name="drawing_elem"]').val('');
    
    if(detail.item) $('#create_order_add_element_box input[name="item_elem"]').val(detail.item);
    else $('#create_order_add_element_box input[name="item_elem"]').val('');
    
    if(detail.variant) $('#create_order_add_element_box input[name="variant_elem"]').val(detail.variant);
    else $('#create_order_add_element_box input[name="variant_elem"]').val('');
    
    if(detail.rus) $('#create_order_add_element_box input[name="title_elem"]').val(detail.rus);
    else $('#create_order_add_element_box input[name="title_elem"]').val(detail.eng);
    
    $('#create_order_add_element_box input[name="weight_one_elem"]').val(detail.weight);
    $('#create_order_add_element_box input[name="count_elem"]').val('');//reset data field 
    $('#create_order_add_element_box input[name="weight_all_elem"]').val('');//reset data field
    console.log(detail.material);
    if(detail.material) $('#create_order_add_element_box input[name="material_elem"]').val(detail.material);
    else $('#create_order_add_element_box input[name="material_elem"]').val('');
    
    
    //create link to drawing detail(unit))
    if(file) {
        var param = file.split('.');
        var ext = param[1];
        path = '/media/drawings/' + detail.equipment + '/' + ext + '/' + file;
        $('#link_image_add_elem').attr('href', path);
    }
    
    alert('Поиск завершен');
};