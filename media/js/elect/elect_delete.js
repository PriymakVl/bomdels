$(document).ready(function() {
    $('#delete_elect_element').click(function() {
        var elect_id = $('#elect_box :radio:checked').attr('elect_id');
        var role = $('#elect_box').attr('role'); 
        var type_list = $('#elect_box').attr('type_list');
        
        if (!role) {alert('Для редактирования списка вам необходимо авторизоваться'); return;}
        else if(type_list == 'default' && role != 'admin') {alert('У вас нет прав редактировать этот список'); return;}
        
        location.href = '/elect/delete?elect_id=' + elect_id;
    });
});