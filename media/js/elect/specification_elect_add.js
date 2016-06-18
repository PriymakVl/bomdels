$(document).ready(function() {
    $('#add_elect').click(function() {
        $('.cat-data :radio:checked').each(function() {
            var elem_id = $(this).attr('detail_id');
            var kind = $(this).attr('equipment');
            var role = $(this).attr('role');
            if (!role) {alert('Для добавления в список популярных вам необходимо авторизоваться')}
            else if (role == 'admin') location.href = '/elect/adddefault?elem_id=' + elem_id + '&kind=' + kind;
            else location.href = '/elect/addemployee?elem_id=' + elem_id + '&kind=' + kind;
        });
    });
});