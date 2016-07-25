$(document).ready(function() {
    $('#add_elect').click(function() {       
            var elem_id = $('.cat-data :radio:checked').attr('cat_id');
            var kind = 'category';
            var role = $('.cat-data :radio:checked').attr('role');
            if (!role) {
                alert('Для добавления в элемента в свой список вам необходимо авторизоваться');
            }
            else location.href = '/elect/addelectelement?elem_id=' + elem_id + '&kind=' + kind;
    });
});