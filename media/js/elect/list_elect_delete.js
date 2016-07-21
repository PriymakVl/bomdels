$(document).ready(function() {
    $('#delete_list_elect').click(function() { 
        
        if (!$('#edit_list_box :radio').is(':checked')) {
            alert('Вы не выбрали список'); 
            return false;
        }
        
        var list_id = $('#edit_list_box :radio:checked').attr('list_id');

        var role = $('#elect_box :radio:checked').attr('role'); 
        var type_list = $('#elect_box :radio:checked').attr('type_list');
        
        if(type_list == 'default' && role != 'admin') {alert('У вас нет прав редактировать этот список'); return;}
        $.get('/elect/deleteList', {list_id: list_id}, resultDeleteList);
        
    });
});

function resultDeleteList(data) {
    if(data == 'full'){
        alert('Список не возможно удалить так как в нем имеются элементы');
    }
    else if (data) {
        alert('Список успешно удален');
        location.href = '/';
    }
    else alert('Ошибка при удалении списка');
}