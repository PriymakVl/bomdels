$(document).ready(function() {
    $('#add_elect').click(function() {
        var elem_id = $('#detail_id').val();
        var kind = $('#equipment').val();
        var role = $('#role').val();
        if (!role) {alert('Для добавления в список популярных вам необходимо авторизоваться');}
        else if(role == 'admin') location.href = '/elect/adddefault?elem_id=' + elem_id + '&kind=' + kind;
        else location.href = '/elect/addemployee?elem_id=' + elem_id + '&kind=' + kind;
    });
});