$(document).ready(function() {
    $('#add_list_menu').click(function(event) {  
            event.preventDefault();

            var employee_id = $(this).attr('employee_id');
            if (!employee_id) {alert('Для добавления списка в меню вам необходимо авторизоваться'); return;}
            
            var list_id = $('#edit_list_box :radio:checked').attr('list_id');
            if (!list_id) {alert('Вы не выбрали список'); return;}
            
            $.post('electlist/addlistmenu', {list_id: list_id}, resultAddListMenu);
    });
});

function resultAddListMenu(data) {
    if(data == '1') alert('Список добавлен в меню "Мои списки"');
    else alert('Ошибка при добавлении списка в ваше меню')
}