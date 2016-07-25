$(document).ready(function() {
    $('#delete_list_elect').click(function() { 

        var list_id = $('#edit_list_box :radio:checked').attr('list_id');
        console.log(list_id);
        if(!list_id) {
            alert('Вы не выбрали список'); 
            return false;    
        }
        
        $.get('/elect/deleteList', {list_id: list_id}, resultDeleteList);
        
    });
});

function resultDeleteList(data) {
    alert(data); return;
    if(data == 'full'){
        alert('Список не возможно удалить так как в нем имеются элементы');
    }
    else if (data) {
        alert('Список успешно удален');
        location.href = '/';
    }
    else alert('Ошибка при удалении списка');
}