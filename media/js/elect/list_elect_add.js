$(document).ready(function() {
    $('#add_list').click(function(event) {  
            event.preventDefault();
            var user_id = $('#form_list input[name="user_id"]').val();
            if (!user_id) {alert('Для добавления списка вам необходимо авторизоваться'); return;}
            
            var list_name = $('#form_list input[name="listname"]').val();
            if (!list_name) {alert('Вы не указали название списка'); return;}
            
            $('#form_list').attr('action', '/elect/addlist').submit();
            
    });
});