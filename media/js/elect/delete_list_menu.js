$(document).ready(function() {
    $('#delete_list_menu').click(function(event) {  
            event.preventDefault();

            var user_id = $(this).attr('user_id');
            if (!user_id) {alert('Для удаления списка из меню вам необходимо авторизоваться'); return;}
            
            var list_id = $('#edit_list_box :radio:checked').attr('list_id');
            if (!list_id) {alert('Вы не выбрали список'); return;}
            
            $.post('electlist/deletelistmenu', {list_id: list_id}, resultDeleteListMenu);
    });
});

function resultDeleteListMenu(data) {
    if(data == 'not') alert('Ошибка при удалении списка из вашего меню "Мои списки"');
    else {
        alert('Список удален из вашего меню');
        location.reload();    
    }
}