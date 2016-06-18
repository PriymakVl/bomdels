$(document).ready(function() {
    //count total weight element
	$('#count_weight_elem').click(function() {
	   $('input[name="weight_all_elem"]').val('');
	   var count = $('input[name="count_elem"]').val();
       var weight = $('input[name="weight_one_elem"]').val();
       if(!count) {alert("Не указано количество деталей(узлов)"); return;}
       if(!weight) {alert('Не указан вес детали(узла)'); return;}
        weight = weight.replace(/\,/, '.');//for count
        var total_weight_elem = count * weight;
        weight_elems = Math.ceil(total_weight_elem*100)/100;//round of number
        $('input[name="weight_all_elem"]').val(weight_elems);
	});
    
    //add element in of conten the order
    $('#add_element_to_content').click(function() {
        var code = $('#create_order_add_element_box input[name="code_elem"]').val();
        var file = $('#create_order_add_element_box input[name="drawing_elem"]').val();
        var item = $('#create_order_add_element_box input[name="item_elem"]').val();
        var variant = $('#create_order_add_element_box input[name="variant_elem"]').val();
        var title = $('#create_order_add_element_box input[name="title_elem"]').val();
        var count = $('#create_order_add_element_box input[name="count_elem"]').val();
        var weight_one_elem = $('#create_order_add_element_box input[name="weight_one_elem"]').val();
        var weight_all_elem = $('#create_order_add_element_box input[name="weight_all_elem"]').val();
         
        var analog = $('#create_order_add_element_box input[name="analog_elem"]').val();       
        var material_elem = $('#create_order_add_element_box input[name="material_elem"]').val();
        material_elem = analog ? analog : material_elem;
        if(!material_elem) {alert('Вы не указали материал детали'); return;}
        
        //to prohibit the insertion unless the weight or the number of
        if(!count || !weight_all_elem) {alert('Вы не указали количество или вес всех деталей(узлов)'); return;}
        
        var list = (!path) ? 'Лист 1' : '<a href="' + path + '">Лист 1</a>';
        
        var row = '<tr><td><input type="radio" name="element" weight_all_elem="' + weight_all_elem + '"/></td>';
        row += '<td>' + code + '</td><td>' + list + '</td><td>' + item + '</td><td style="text-align: left; padding-left: 3px;">' + title + '</td><td>' + count + '</td>';
        row += '<td>' + weight_one_elem + ' кг</td><td>' + weight_all_elem + ' кг</td><td>' + material_elem + '</td></tr>'; 
        //add row in table content
        $('#create_order_content_box table').append(row);
        //pass on tab conten
         $('.menu-create-order-wrp li').each(function() {
           $(this).removeClass('menu-create-order-active');
        });
        $('#show_content_create_order_box').addClass('menu-create-order-active');
        $('#create_order_info_box').hide();
        $('#create_order_add_element_box').hide();
        $('#save_new_order').show();
        $('#add_element_to_content').hide();
        $('#create_order_content_box').slideDown(300);
        
        //count total weight order
        var weight_order = 0;
        $('#create_order_content_box input[weight_all_elem]').each(function() {
           var weight_str = $(this).attr('weight_all_elem');
           var weight_int = parseFloat(weight_str);
           weight_order +=  weight_int;
        });
        $('#create_order_info_box input[name="weight_order"]').val(weight_order);
    }); 
    
    //add elect material in field input
    $('#add_elect_material').change(function() {
        var mat_elem = $(this).val();
        $('#create_order_add_element_box input[name="material_elem"]').val(mat_elem);
        this.selectedIndex = 0;//reset select
    });
    
    //add elect analog in field input
    $('#add_elect_analog').change(function() {
        var mat_anal = $(this).val();
        $('#create_order_add_element_box input[name="analog_elem"]').val(mat_anal);
        this.selectedIndex = 0;//reset select
    });
    
});

















