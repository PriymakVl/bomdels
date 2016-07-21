$(document).ready(function() {
    $('#delete_elect_element').click(function() {
        var elect_id = $('#elect_box :radio:checked').attr('elect_id');
        var role = $('#elect_box :radio:checked').attr('role'); 
        var type_list = $('#elect_box :radio:checked').attr('type_list');
        if(type_list == 'default' && role != 'admin') {alert('У вас нет прав редактировать этот список'); return;}
        location.href = '/elect/delete?elect_id=' + elect_id;
    });
});