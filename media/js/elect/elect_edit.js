$(document).ready(function() {
//    $('#save_elem').click(function(event) {  
//        event.preventDefault();
//        $('#form_elem').submit();   
//    });
    
    //insert data in input of form
    $('#edit_elect_element').click(function() {
        //check selected be element 
        if (!$('#elect_box :radio').is(':checked')) {alert('Вы не выбрали элемент'); return false;}
        
        var role = $('#elect_box').attr('role'); 
        var type_list = $('#elect_box').attr('type_list');

        if (!role) {alert('Для редактирования списка вам необходимо авторизоваться'); return;}
        else if(type_list == 'default' && role != 'admin') {alert('У вас нет прав редактировать этот список'); return;}
        
        var checked = $('#elect_box :radio:checked');
        var rating = checked.attr('rating');
        var description_elect = checked.attr('description_elect');
        var name = checked.attr('name_elem');
        var elect_id = checked.attr('elect_id');
        

        $('#element_form_box').slideDown();
        
        $('#form_element input[name="elect_id"]').val(elect_id);
        $('#form_element input[name="name_elem"]').val(name);
        $('#form_element input[name="rating"]').val(rating);
        $('#form_element textarea').text(description_elect);
        
    });
});