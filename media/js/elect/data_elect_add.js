$(document).ready(function() {
    $('#add_elect').click(function() {
        var elem_id = $('#detail_id').val();
        var kind = $('#equipment').val();
        var role = $('#role').val();
        if (!role) {
            alert('Для добавления в элемента в свой список вам необходимо авторизоваться');
        }
        else location.href = '/elect/addelectelement?elem_id=' + elem_id + '&kind=' + kind;
    });
});